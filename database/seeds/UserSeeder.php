<?php

use Illuminate\Database\Seeder;
use Vanguard\Role;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\CompanyUser;
use Vanguard\Experience;
use Vanguard\User;
use Vanguard\Profile;
use Vanguard\Point;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Admin Test',
            'email'      => 'admin@example.com',
            'username'   => 'admin',
            'password'   => 'admin123',
            'address_id' => null,
            'status'     => UserStatus::ACTIVE,
            'code'       => 'admingtalents',
            'is_active'  => '1',
            'category_id' => null,
        ]);

        $role = Role::where('name', 'Admin')->first();

        $user->attachRole($role);
        $user->socialNetworks()->create([]);

        $user = User::create([
            'first_name' => 'AdminConsultant Test',
            'email'      => 'test2@example.com',
            'username'   => 'test2',
            'password'   => 'secret',
            'address_id' => null,
            'status'     => UserStatus::ACTIVE,
            'code'       => 'gtalents2',
            'is_active'  => '1',
            'category_id' => '1',
        ]);

        $role = Role::where('name', 'AdminConsultant')->first();

        $user->attachRole($role);
        $user->socialNetworks()->create([]);

        $data = [ 'company_id' => 1,
                  'user_id'     => $user->id,
                  'is_active'   => true,
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        CompanyUser::create($data);
        Point::create(['user_id' => $user->id, 'sum' => 25 ]);

        $user = User::create([
            'first_name' => 'Test 3',
            'email'      => 'test3@example.com',
            'username'   => 'test3',
            'password'   => 'secret',
            'address_id' => null,
            'status'     => UserStatus::ACTIVE,
            'code'       => 'gtalents3',
            'is_active'  => '1',
            'category_id' => '1',
        ]);

        $role = Role::where('name', 'Consultant')->first();

        $user->attachRole($role);
        $user->socialNetworks()->create([]);

        $data = [ 'company_id' => 1,
                  'user_id'     => $user->id,
                  'is_active'   => true,
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        CompanyUser::create($data);
        Point::create(['user_id' => $user->id, 'sum' => 25 ]);

        $user = User::create([
            'first_name' => 'Test 4',
            'email'      => 'test4@example.com',
            'username'   => 'test4',
            'password'   => 'secret',
            'address_id' => null,
            'status'     => UserStatus::UNCONFIRMED,
            'code'       => 'gtalents4',
            'confirmation_token' => 'i96TXbzyx5ujlC1zvMJ5K0xUHfICzD2hstnN3ZwBXFt787JDD12lmFRoS3xf',
            'is_active'  => '1',
            'category_id' => '1',
        ]);

        $role = Role::where('name', 'Consultant')->first();

        $user->attachRole($role);
        $user->socialNetworks()->create([]);

        $data = [ 'company_id' => 1,
                  'user_id'     => $user->id,
                  'is_active'   => true,
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        CompanyUser::create($data);
        Point::create(['user_id' => $user->id, 'sum' => 25 ]);
    }
}
