<?php

namespace Vanguard\Http\Controllers;

use Vanguard\Events\User\ChangedAvatar;
use Vanguard\Events\User\TwoFactorDisabled;
use Vanguard\Events\User\TwoFactorEnabled;
use Vanguard\Events\User\UpdatedUserDetails;
use Vanguard\Http\Requests\User\EnableTwoFactorRequest;
use Vanguard\Http\Requests\User\UpdateUserDetailsRequest;
use Vanguard\Http\Requests\User\UpdateUserLoginDetailsRequest;
use Vanguard\Http\Requests\User\UpdateUserRequest;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;
use Vanguard\Experience;
use Auth;
use Authy;
use Illuminate\Http\Request;

/**
 * Class UserDetailsController
 * @package Vanguard\Http\Controllers
 */
class UserDetailsController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);

        $this->users = $users;
        $this->theUser = Auth::user();
    }

    /**
     * Display user's details page.
     *
     * @param RoleRepository $rolesRepo
     * @param CountryRepository $countryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RoleRepository $rolesRepo, 
                        CountryRepository $countryRepository)
    {
        $user = $this->theUser;
        $edit = true;
        $roles = $rolesRepo->lists();
        $socials = $user->socialNetworks;
        $countries = $countryRepository->lists()->toArray();
        $socialLogins = $this->users->getUserSocialLogins($this->theUser->id);
        $statuses = UserStatus::lists();

        return view('user.details',
                compact('user', 'edit', 'roles', 'countries', 'socialLogins', 'socials', 'statuses'));
    }

    /**
     * Update user details.
     *
     * @param UpdateUserDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(UpdateUserDetailsRequest $request)
    {
        $this->users->update($this->theUser->id, $request->except('role', 'status'));

        event(new UpdatedUserDetails);

        return redirect()->back()
            ->withSuccess(trans('app.user_details_updated_successfully'));
    }

    /**
     * Upload and update user's avatar.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(Request $request, UserAvatarManager $avatarManager)
    {
        $name = $avatarManager->uploadAndCropAvatar($this->theUser);

        return $this->handleAvatarUpdate($name);
    }

    /**
     * Update avatar for currently logged in user
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar)
    {
        $this->users->update($this->theUser->id, ['avatar' => $avatar]);

        event(new ChangedAvatar);

        return redirect()->route('user_details')
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($this->theUser);

        return $this->handleAvatarUpdate($request->get('url'));
    }

    /**
     * Update user's social networks.
     *
     * @param Request $request
     * @return mixed
     */
    public function updateSocialNetworks(Request $request)
    {
        $this->users->updateSocialNetworks($this->theUser->id, $request->get('socials'));

        return redirect()->route('user_details')
            ->withSuccess(trans('app.socials_updated'));
    }

    /**
     * Update user's login details.
     *
     * @param UpdateUserLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(UpdateUserLoginDetailsRequest $request)
    {
        $data = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (trim($data['password']) == '') {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($this->theUser->id, $data);

        return redirect()->route('user_details')
            ->withSuccess(trans('app.login_updated'));
    }

    /**
     * Enable 2FA for currently logged user.
     *
     * @param EnableTwoFactorRequest $request
     * @return $this
     */
    public function enableTwoFactorAuth(EnableTwoFactorRequest $request)
    {
        if (Authy::isEnabled($this->theUser)) {
            return redirect()->route('user.edit', $this->theUser->id)
                ->withErrors(trans('app.2fa_already_enabled'));
        }

        $this->theUser->setAuthPhoneInformation($request->country_code, $request->phone_number);

        Authy::register($this->theUser);

        $this->theUser->save();

        event(new TwoFactorEnabled);

        return redirect()->route('user_details')
            ->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disable 2FA for currently logged user.
     *
     * @return $this
     */
    public function disableTwoFactorAuth()
    {
        if (! Authy::isEnabled($this->theUser)) {
            return redirect()->route('user_details')
                ->withErrors(trans('app.2fa_not_enabled_for_this_user'));
        }

        Authy::delete($this->theUser);

        $this->theUser->save();

        event(new TwoFactorDisabled);

        return redirect()->route('user_details')
            ->withSuccess(trans('app.2fa_disabled'));
    }

    /**
     * Display user activity log.
     *
     * @param ActivityRepository $activitiesRepo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity(ActivityRepository $activitiesRepo, Request $request)
    {
        $perPage = 20;
        $user = $this->theUser;

        $activities = $activitiesRepo->paginateActivitiesForUser(
            $this->theUser->id, $perPage, $request->get('search')
        );

        return view('activity.index', compact('activities', 'user'));
    }


    /**
     * Display active sessions for current user.
     *
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(SessionRepository $sessionRepository)
    {
        $user_details = true;
        $user = $this->theUser;
        $sessions = $sessionRepository->getUserSessions($user->id);

        return view('user.sessions', compact('sessions', 'user', 'user_details'));
    }

    /**
     * Invalidate user's session.
     *
     * @param $sessionId
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession($sessionId, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateUserSession(
            $this->theUser->id,
            $sessionId
        );

        return redirect()->route('user_details.sessions')
            ->withSuccess(trans('app.session_invalidated'));
    }
}