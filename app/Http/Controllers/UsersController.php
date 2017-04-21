<?php

namespace Vanguard\Http\Controllers;

use Vanguard\Address;
use Vanguard\Company;
use Vanguard\CompanyUser;
use Vanguard\Country;
use Vanguard\Events\User\Banned;
use Vanguard\Events\User\Deleted;
use Vanguard\Events\User\TwoFactorDisabledByAdmin;
use Vanguard\Events\User\TwoFactorEnabledByAdmin;
use Vanguard\Events\User\UpdatedByAdmin;
use Vanguard\ExperienceFunctionalArea;
use Vanguard\ExperienceIndustry;
use Vanguard\Http\Requests\User\CreateUserRequest;
use Vanguard\Http\Requests\User\EnableTwoFactorRequest;
use Vanguard\Http\Requests\User\UpdateDetailsRequest;
use Vanguard\Http\Requests\User\UpdateLoginDetailsRequest;
use Vanguard\Http\Requests\User\UpdateUserRequest;
use Vanguard\LegalInformation;
use Vanguard\Preference;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;
use Vanguard\Experience;
use Vanguard\Profile;
use Auth;
use Authy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Vanguard\Repositories\QuantityEmployees\QuantityEmployeesRepository;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\EducationLevel\EducationLevelRepository;
use Vanguard\Repositories\SecurityQuestion\SecurityQuestionRepository;
use Vanguard\Repositories\SourcingNetwork\SourcingNetworkRepository;
use Vanguard\Repositories\Contact\ContactRepository;
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
use Vanguard\Repositories\Address\AddressRepository;

/**
 * Class UsersController
 * @package Vanguard\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    private $countries;

    private $address;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users,
                                CountryRepository $countries,
                                AddressRepository $address)
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        $this->middleware('permission:users.manage', ['except' => ['profile', 'profileUpdate', 'updateProfileAdmin']]);
        $this->users = $users;
        $this->countries = $countries;
        $this->address = $address;
        $this->theUser = Auth::user();
    }

    /**
     * Display paginated list of all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $perPage = 20;

        $users = $this->users->paginate($perPage, Input::get('search'), Input::get('status'));
        $statuses = ['' => trans('app.all')] + UserStatus::lists();

        return view('user.index', compact('users', 'statuses'));
    }

    /**
     * Displays user details page.
     *
     * @param User $user
     * @param ActivityRepository $activities
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user, ActivityRepository $activities)
    {
        if($this->theUser->hasRole('AdminConsultant'))
            if($this->users->findByCompany($user->id) == 0)
                return redirect()->route('user.index')
                    ->withErrors(trans('app.only_access_users_of_your_company')); 

        $socialNetworks = $user->socialNetworks;

        $userActivities = $activities->getLatestActivitiesForUser($user->id, 10);

        return view('user.view', compact('user', 'socialNetworks', 'userActivities'));
    }

    /**
     * Displays form for creating a new user.
     *
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        $countries = $countryRepository->lists();
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();

        return view('user.add', compact('countries', 'roles', 'statuses'));
    }

    /**
     * Stores new user into the database.
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        // When user is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + ['status' => UserStatus::ACTIVE];

        // Username should be updated only if it is provided.
        // So, if it is an empty string, then we just leave it as it is.
        if (trim($data['username']) == '') {
            $data['username'] = null;
        }

        $user = $this->users->create($data);
        $this->users->updateSocialNetworks($user->id, []);
        $this->users->setRole($user->id, $request->get('role'));

        if($request->get('role') == 4 Or $request->get('role') == 5 Or $request->get('role') == 6){

            $profile = Profile::create(['user_id' => $user->id, 'category_id' => 1]);
            $experience = Experience::create(['profile_id' => $profile->id]);

            if($this->theUser->hasRole('AdminConsultant')){
                $dataCompany = [ 'is_active'  => true,
                          'created_at' => \Carbon\Carbon::now(),
                          'updated_at' => \Carbon\Carbon::now() ];

                $this->users->company($user->id)->attach($this->theUser->company_user->company_id, $dataCompany);
            }
        }

        return redirect()->route('user.index')
            ->withSuccess(trans('app.user_created'));
    }

    /**
     * Displays edit user form.
     *
     * @param User $user
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user, CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        if($this->theUser->hasRole('AdminConsultant'))
            if($this->users->findByCompany($user->id) == 0)
                return redirect()->route('user.index')
                    ->withErrors(trans('app.only_access_users_of_your_company')); 

        $edit = true;
        $countries = $countryRepository->lists();
        $socials = $user->socialNetworks;
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();
        $socialLogins = $this->users->getUserSocialLogins($user->id);
        return view('user.edit',
            compact('edit', 'user', 'countries', 'socials', 'socialLogins', 'roles', 'statuses'));
    }

    /**
     * Updates user details.
     *
     * @param User $user
     * @param UpdateDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(User $user, UpdateDetailsRequest $request)
    {
        $this->users->update($user->id, $request->all());
        $this->users->setRole($user->id, $request->get('role'));

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userIsBanned($user, $request)) {
            event(new Banned($user));
        }

        return redirect()->back()
            ->withSuccess(trans('app.user_updated'));
    }

    /**
     * Check if user is banned during last update.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    private function userIsBanned(User $user, Request $request)
    {
        return $user->status != $request->status && $request->status == UserStatus::BANNED;
    }

    /**
     * Update user's avatar from uploaded image.
     *
     * @param User $user
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(User $user, UserAvatarManager $avatarManager)
    {
        $name = $avatarManager->uploadAndCropAvatar($user);

        $this->users->update($user->id, ['avatar' => $name]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(User $user, Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->id, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's social networks.
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function updateSocialNetworks(User $user, Request $request)
    {
        $this->users->updateSocialNetworks($user->id, $request->get('socials'));

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.socials_updated'));
    }

    /**
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (trim($data['password']) == '') {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->id, $data);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.login_updated'));
    }

    /**
     * Removes the user from database.
     *
     * @param User $user
     * @return $this
     */
    public function delete(User $user)
    {
        if($this->theUser->hasRole('AdminConsultant'))
            if($this->users->findByCompany($user->id) == 0)
                return redirect()->route('user.index')
                    ->withErrors(trans('app.only_access_users_of_your_company')); 
                    
        if ($user->id == Auth::id()) {
            return redirect()->route('user.index')
                ->withErrors(trans('app.you_cannot_delete_yourself'));
        }

        $this->users->delete($user->id);

        event(new Deleted($user));

        return redirect()->route('user.index')
            ->withSuccess(trans('app.user_deleted'));
    }

    /**
     * Enables Authy Two-Factor Authentication for user.
     *
     * @param User $user
     * @param EnableTwoFactorRequest $request
     * @return $this
     */
    public function enableTwoFactorAuth(User $user, EnableTwoFactorRequest $request)
    {
        if (Authy::isEnabled($user)) {
            return redirect()->route('user.edit', $user->id)
                ->withErrors(trans('app.2fa_already_enabled_user'));
        }

        $user->setAuthPhoneInformation($request->country_code, $request->phone_number);

        Authy::register($user);

        $user->save();

        event(new TwoFactorEnabledByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disables Authy Two-Factor Authentication for user.
     *
     * @param User $user
     * @return $this
     */
    public function disableTwoFactorAuth(User $user)
    {
        if (! Authy::isEnabled($user)) {
            return redirect()->route('user.edit', $user->id)
                ->withErrors(trans('app.2fa_not_enabled_user'));
        }

        Authy::delete($user);

        $user->save();

        event(new TwoFactorDisabledByAdmin($user));

        return redirect()->route('user.edit', $user->id)
            ->withSuccess(trans('app.2fa_disabled'));
    }


    /**
     * Displays the list with all active sessions for selected user.
     *
     * @param User $user
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(User $user, SessionRepository $sessionRepository)
    {
        $adminView = true;
        $sessions = $sessionRepository->getUserSessions($user->id);

        return view('user.sessions', compact('sessions', 'user', 'adminView'));
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $sessionId
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession(User $user, $sessionId, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateUserSession($user->id, $sessionId);

        return redirect()->route('user.sessions', $user->id)
            ->withSuccess(trans('app.session_invalidated'));
    }

    public function profile(QuantityEmployeesRepository $quantityEmployees,
                            ExperienceYearRepository $experienceYears,
                            EducationLevelRepository $educationLevels,
                            SecurityQuestionRepository $securityQuestions,
                            SourcingNetworkRepository $sourcingNetworks,
                            ContactRepository $contacts,
                            FunctionalAreaRepository $functionalArea,
                            IndustryRepository $industries)
    {
        $user = Auth::user();
        session(['lang' => \App::getLocale()]);
        if (session('lang') =='en')
            $language = 2;
        else
            $language = 1;
        $countries = $this->countries->lists()->toArray();
        $quantityEmployees = $quantityEmployees->lists($language);
        $experienceYears = $experienceYears->lists($language);
        $educationLevels = $educationLevels->lists($language);
        $securityQuestions = $securityQuestions->lists($language);
        $currencies = $this->countries->lists('currency_code', 'id')->toArray();
        $sourcingNetworks = $sourcingNetworks->lists($language);
        $contacts = $contacts->lists($language);
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);

        try{
            $address = Address::find($user->address_id);
        } catch (\Exception $e){
            $address = '';
        }
        try{
            $preferences = Preference::where('user_id', $user->id)->get()->first();
        } catch (\Exception $e){
            $preferences = '';
        }

        if($user->company_user->position==1){
            try{
                $company = Company::find($user->company_user->company_id);
            } catch(\Exception $e){
                $company = '';
            }
            try{
                $legal = LegalInformation::where('user_id', $user->id)->get()->first();
            } catch(\Exception $e){
                $legal = '';
            }
            if($legal!=''){
                $address2 = Address::find($legal->address_id);
                $country_id2 = Country::find($address2->state->country_id)->id;
            } else {
                $address2 = '';
                $country_id2 = '';
            }
            $expe = Experience::where('company_id', $user->company_user->company_id)->get()->first();
            $industries_id = [];
            $industries_name = [];
            $indus = ExperienceIndustry::where('experience_id', $expe->id)->get();
            foreach($indus as $na){
                $industries_id[] = $na->industry_id;
                $industries_name[] = $na->industry($language)->name;
            }
            $funcala_id = [];
            $funcala_name = [];
            $funca = ExperienceFunctionalArea::where('experience_id', $expe->id)->get();
            foreach($funca as $na){
                $funcala_id[] = $na->functional_area_id;
                $funcala_name[] = $na->functional($language)->name;
            }
            return view('dashboard_user.profile.confirm', compact('user',
                'address',
                'address2',
                'country_id2',
                'legal',
                'preferences',
                'token',
                'industries_name',
                'industries_id',
                'funcala_name',
                'funcala_id',
                'company',
                'countries',
                'quantityEmployees',
                'experienceYears',
                'educationLevels',
                'securityQuestions',
                'currencies',
                'sourcingNetworks',
                'contacts',
                'functionalArea',
                'industries'));
        } else {
            return view('dashboard_user.profile.confirmcollaborator', compact('user',
                'address',
                'preferences',
                'token',
                'countries',
                'quantityEmployees',
                'experienceYears',
                'educationLevels',
                'securityQuestions',
                'currencies',
                'sourcingNetworks',
                'contacts',
                'functionalArea',
                'industries'));
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        if(isset($request->state) && $request->state!=''){
            $dataAddress1 = ['state_id'  => $request->state,
                'city'       => $request->city,
                'address'    => $request->address,
                'complement' => $request->complement,
                'zip_code'   => $request->zip_code,
                'is_active'  => 1];

            $address1 = $this->address->create($dataAddress1);
        }

        $dataUser = ['prefix'              => $request->prefix,
            'first_name'           => $request->first_name,
            'last_name'            => $request->last_name,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone,
            //'school_assisted'      => $request->school_assisted,
            //'memberships'          => $request->memberships,
            'country_id'           => $request->country_id,
            'confirmation_token'   => null
        ];

        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        if(isset($request->years_recruitment_id)){
            $dataUser['years_recruitment_id'] = $request->years_recruitment_id;
        }

        if(isset($request->education_level_id)){
            $dataUser['education_level_id'] = $request->education_level_id;
        }

        $this->users->update($user->id, $dataUser);

        $dataPreference = [ 'user_id'              => $user->id,
            'security_question1_id'   => $request->security_question1,
            'answer1'              => $request->answer1,
            'security_question2_id'   => $request->security_question2,
            'answer2'              => $request->answer1,
            'receive_messages'     => $request->receive_messages
        ];

        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
        }

        if(isset($request->contact_id) && $request->organization_role_id!=''){
            $dataPreference['organization_role_id'] = $request->organization_role_id;
        }

        if(isset($request->contact_id) && $request->sourcing_network_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_network_id;
        }

        if($preference = Preference::where('user_id', $user->id)->get()->first()){
            $preference->update($dataPreference);
        } else {
            Preference::create($dataPreference);
        }

        if(isset($request->state2) && $request->state2!=''){
            $dataAddress2 = ['state_id'  => $request->state2,
                'city'       => $request->city2,
                'address'    => $request->address2,
                'complement' => $request->complement2,
                'zip_code'   => $request->zip_code2,
                'is_active'  => 1
            ];

            $address2 = $this->address->create($dataAddress2);
        }

        return redirect()->back()
            ->withSuccess(trans('app.update_profile_success'));
    }

    public function updateProfileAdmin(Request $request)
    {
        $user = Auth::user();

        if(isset($request->state) && $request->state!=''){
            $dataAddress1 = ['state_id'  => $request->state,
                'city'       => $request->city,
                'address'    => $request->address,
                'complement' => $request->complement,
                'zip_code'   => $request->zip_code,
                'is_active'  => 1];

            $address1 = $this->address->create($dataAddress1);
        }

        $dataUser = ['prefix'              => $request->prefix,
            'first_name'           => $request->first_name,
            'last_name'            => $request->last_name,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone,
            'school_assisted'      => $request->school_assisted,
            'memberships'          => $request->memberships,
            'confirmation_token'   => null
        ];

        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        if(isset($request->years_recruitment_id)){
            $dataUser['years_recruitment_id'] = $request->years_recruitment_id;
        }

        if(isset($request->education_level_id)){
            $dataUser['education_level_id'] = $request->education_level_id;
        }

        $this->users->update($user->id, $dataUser);

        $dataCompany = ['name'                  => $request->company_name,
            'comercial_name'        => $request->company_name,
            'website'               => $request->website,
            'address_id'            => $address1->id,
            'quantity_employees_id' => $request->quantity_employees_id,
            'description'           => $request->description,
            'is_active'             => 1
        ];

        Company::find($user->company_user->company_id)->update($dataCompany);

        $industries = explode(',', $request->industries);
        $funcala = explode(',', $request->funcala);
        $expe = Experience::where('company_id', $user->company_user->company_id)->get()->first();
        //ExperienceIndustry::delete(['experience_id' => $expe->id]);
        foreach($industries as $in){
            ExperienceIndustry::create(['experience_id' => $expe->id, 'industry_id' => $in]);
        }
        foreach($funcala as $fu){
            ExperienceFunctionalArea::create(['experience_id' => $expe->id, 'functional_area_id' => $fu]);
        }

        $dataPreference = [ 'user_id' => $user->id,
            'security_question1_id' => $request->security_question1,
            'answer1' => $request->answer1,
            'security_question2_id' => $request->security_question2,
            'answer2' => $request->answer1,
            'receive_messages' => $request->receive_messages
        ];

        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
        }

        if(isset($request->organization_role) && $request->organization_role!=''){
            $dataPreference['organization_role_id'] = $request->organization_role;
        }

        if(isset($request->sourcing_networks_id) && $request->sourcing_networks_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_networks_id;
        }

        if($preference = Preference::where('user_id', $user->id)->get()->first()){
            $preference->update($dataPreference);
        } else {
            Preference::create($dataPreference);
        }

        $dataAddress2 = ['state_id'  => $request->state2,
            'city'       => $request->city2,
            'address'    => $request->address2,
            'complement' => $request->complement2,
            'zip_code'   => $request->zip_code2,
            'is_active'  => 1
        ];

        $address2 = $this->address->create($dataAddress2);

        $dataLegal = [ 'user_id' => $user->id,
            'legal_first_name'   => $request->legal_first_name,
            'legal_last_name'    => $request->legal_last_name,
            'legal_company_name' => $request->legal_company_name,
            'company_type'       => $request->company_type,
            'principal_coin'     => $request->principal_coin,
            'accept_terms_cond'  => $request->accept_terms_cond,
            'address_id'         => $address2->id
        ];
        if($le = LegalInformation::where('user_id', $user->id)->get()->first()){
            $le->update($dataLegal);
        } else {
            LegalInformation::create($dataLegal);
        }

        return redirect()->back()
            ->withSuccess(trans('app.update_profile_success'));
    }
}