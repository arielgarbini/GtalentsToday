<?php


use Vanguard\Events\User\ChangedAvatar;
use Vanguard\Events\User\UpdatedUserDetails;
use Vanguard\Role;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;
use Carbon\Carbon;

class UserDetailsControllerTest extends FunctionalTestCase
{
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = $this->createAndLoginUser();
    }

    public function test_can_access_user_details_page()
    {
        $this->visit('/')
            ->click('My User Details')
            ->seePageIs('user_details');
    }

    public function test_update_details()
    {
        $this->expectsEvents(UpdatedUserDetails::class);

        $data = $this->getStubDetailsData();

        $this->visit('user_details')
            ->submitForm('Update Details', $data)
            ->seePageIs('user_details')
            ->see('User details updated successfully.')
            ->seeInDatabase('users', $data + ['id' => $this->user->id]);
    }

    public function test_cannot_change_role_or_status()
    {
        $data = $this->getStubDetailsData();

        $extendedData = $data + [
            'role' => Role::whereName('Admin')->first()->id,
            'status' => UserStatus::BANNED,
        ];

        $this->visit('user_details')
            ->submitForm('Update Details', $extendedData)
            ->seePageIs('user_details')
            ->see('User details updated successfully.')
            ->seeInDatabase('users', $data + ['id' => $this->user->id, 'status' => UserStatus::ACTIVE])
            ->dontSeeInDatabase('role_user', [
                'user_id' => $this->user->id,
                'role_id' => $extendedData['role']
            ]);
    }

    public function test_update_avatar()
    {
        $this->expectsEvents(ChangedAvatar::class);

        $uploads = ['avatar' => base_path('tests/files/image.png')];

        $input = [
            'points' => [
                'x1' => 0,
                'y1' => 0,
                'x2' => 200,
                'y2' => 200
            ]
        ] + $uploads;

        $this->visit("user_details")
            ->submitForm('Save', $input, $uploads)
            ->seePageIs('user_details')
            ->see('Avatar changed successfully.');

        $user = $this->user->fresh();

        $uploadedFile = public_path("upload/users/{$user->avatar}");

        $this->assertNotNull($user->avatar);
        $this->assertFileExists($uploadedFile);

        list($width, $height) = getimagesize($uploadedFile);

        $this->assertEquals(160, $width);
        $this->assertEquals(160, $height);

        @unlink($uploadedFile);
    }

    public function test_update_avatar_external()
    {
        $this->expectsEvents(ChangedAvatar::class);

        $data = ['url' => '//www.gravatar.com/avatar'];
        $this->post(route('user_details.update.avatar-external', $this->user->id), $data)
            ->followRedirects()
            ->seePageIs('user_details')
            ->see('Avatar changed successfully.');

        $this->seeInDatabase('users', ['id' => $this->user->id, 'avatar' => $data['url']]);
    }

    public function test_update_social_networks()
    {
        $data = [
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'google_plus' => 'g+',
            'linked_in' => 'li',
            'dribbble' => 'Dribble',
            'skype' => 'skyyype'
        ];

        $this->visit("user_details")
            ->submitForm('Update Social Networks', ['socials' => $data])
            ->seeInDatabase('user_social_networks', $data)
            ->seePageIs("user_details")
            ->see("Social networks updated successfully.");
    }

    public function test_update_user_login_details()
    {
        $data = [
            'email' => 'john@doe.com',
            'username' => 'milos',
            'password' => 'milos123123',
            'password_confirmation' => 'milos123123'
        ];

        $this->visit("user_details")
            ->submitForm("update-login-details-btn", $data)
            ->seePageIs("user_details")
            ->see('Login details updated successfully.');

        $user = $this->user->fresh();

        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['username'], $user->username);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

    public function test_password_is_not_changed_if_omitted_on_update()
    {
        $this->user = $this->createAndLoginUser([
            'email' => 'john@doe.com',
            'password' => '123123'
        ]);

        $data = ['email' => 'test@test.com', 'password' => '', 'password_confirmation' => ''];

        $this->visit("user_details")
            ->submitForm("update-login-details-btn", $data)
            ->seePageIs("user_details")
            ->see('Login details updated successfully.');

        $user = $this->user->fresh();

        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check('123123', $user->password));
    }

    public function test_2fa_form_visibility()
    {
        Settings::set('2fa.enabled', false);

        $this->visit("user_details")
            ->dontSee('Two-Factor Authentication');

        Settings::set('2fa.enabled', true);

        $this->visit("user_details")
            ->see('Two-Factor Authentication');
    }

    public function test_enable_2fa()
    {
        $this->expectsEvents(\Vanguard\Events\User\TwoFactorEnabled::class);

        Settings::set('2fa.enabled', true);

        Authy::shouldReceive('isEnabled')->andReturn(false);
        Authy::shouldReceive('register')->andReturnNull();

        $data = ['country_code' => '1', 'phone_number' => '123'];

        $this->visit("user_details")
            ->submitForm('Enable', $data)
            ->seePageIs("user_details")
            ->seeInDatabase('users', [
                'id' => $this->user->id,
                'two_factor_country_code' => $data['country_code'],
                'two_factor_phone' => $data['phone_number']
            ])
            ->see('Two-Factor Authentication enabled successfully.');
    }

    public function test_disable_2fa()
    {
        $this->expectsEvents(\Vanguard\Events\User\TwoFactorDisabled::class);

        Settings::set('2fa.enabled', true);

        Authy::shouldReceive('isEnabled')->andReturn(true);
        Authy::shouldReceive('delete')->andReturnNull();

        $this->visit("user_details")
            ->press('Disable')
            ->seePageIs("user_details")
            ->seeInDatabase('users', [
                'id' => $this->user->id,
                'two_factor_country_code' => null,
                'two_factor_phone' => null
            ])
            ->see('Two-Factor Authentication disabled successfully.');
    }

    public function test_activity_log()
    {
        $logger = app(Vanguard\Services\Logging\UserActivity\Logger::class);

        Carbon::setTestNow(Carbon::now());

        $logger->log('foo');
        $logger->log('bar');

        $buttonSelector = "a[data-content='".Input::header('User-agent')."']";

        $this->visit('user_details/activity')
            ->seeInTable('table', Input::ip(), 1, 1)
            ->seeInTable('table', 'foo', 1, 2)
            ->seeInTable('table', Carbon::now()->toDateTimeString(), 1, 3)
            ->seeElement("table tbody tr:nth-child(1) > td:nth-child(4) > {$buttonSelector}")
            ->seeInTable('table', Input::ip(), 2, 1)
            ->seeInTable('table', 'bar', 2, 2)
            ->seeInTable('table', Carbon::now()->toDateTimeString(), 2, 3)
            ->seeElement("table tbody tr:nth-child(2) > td:nth-child(4) > {$buttonSelector}");
    }

    public function test_session_invalidation()
    {
        putenv('SESSION_DRIVER=database');

        $this->refreshAppAndExecuteCallbacks();

        Carbon::setTestNow(Carbon::now());

        $user = $this->createAndLoginAdminUser();

        $this->visit('user')
            ->click('Active Sessions')
            ->seePageIs("user_details/sessions")
            ->seeInTable('table', Input::ip(), 1, 1)
            ->seeInTable('table', Input::header("User-agent"), 1, 2)
            ->seeInTable('table', Carbon::now()->toDateString(), 1, 3);

        $this->assertEquals(1, $this->crawler->filter("table tbody tr")->count());

        $url = $this->crawler->filter('a[title="Invalidate Session"]')->first()->link()->getUri();

        $this->delete($url)
            ->followRedirects()
            ->dontSeeInDatabase('sessions', ['user_id' => $user->id]);
    }

    /**
     * @return array
     */
    private function getStubDetailsData()
    {
        $data = [
            'first_name' => 'foo',
            'last_name'  => 'bar',
            'birthday'   => Carbon::now()->subYears(25)->format('Y-m-d'),
            'phone'      => '12345667',
            'address'    => 'the address',
            'country_id' => 688 //Serbia,
        ];

        return $data;
    }
}
