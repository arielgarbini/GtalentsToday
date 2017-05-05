<?php

namespace Vanguard\Http\Controllers;

use Vanguard\ActualPosition;
use Vanguard\Address;
use Vanguard\CasesNumber;
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
use Vanguard\ExperienceRegion;
use Vanguard\Http\Requests\User\CreateUserRequest;
use Vanguard\Http\Requests\User\EnableTwoFactorRequest;
use Vanguard\Http\Requests\User\UpdateDetailsRequest;
use Vanguard\Http\Requests\User\UpdateLoginDetailsRequest;
use Vanguard\Http\Requests\User\UpdateUserRequest;
use Vanguard\Jobtitle;
use Vanguard\LegalInformation;
use Vanguard\LevelPosition;
use Vanguard\Point;
use Vanguard\Preference;
use Vanguard\Region;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\TypeInvolvedOpportunity;
use Vanguard\TypeInvolvedOpportunityProfile;
use Vanguard\TypeInvolvedSearch;
use Vanguard\TypeInvolvedSearchProfile;
use Vanguard\TypeSharedOpportunity;
use Vanguard\TypeSharedOpportunityProfile;
use Vanguard\TypeSharedSearch;
use Vanguard\TypeSharedSearchProfile;
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
    public function create(QuantityEmployeesRepository $quantityEmployees,
                           ExperienceYearRepository $experienceYears,
                           EducationLevelRepository $educationLevels,
                           SecurityQuestionRepository $securityQuestions,
                           SourcingNetworkRepository $sourcingNetworks,
                           ContactRepository $contacts,
                           FunctionalAreaRepository $functionalArea,
                           IndustryRepository $industries,
                           CountryRepository $countryRepository,
                           RoleRepository $roleRepository)
    {
        $countries = $countryRepository->lists();
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();
        session(['lang' => \App::getLocale()]);
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }

        $searchTypeShared = TypeSharedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityShared = TypeInvolvedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $searchTypeInvolved = TypeSharedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityInvolved = TypeInvolvedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $quantityEmployees = $quantityEmployees->lists($language);
        $experienceYears = $experienceYears->lists($language);
        $educationLevels = $educationLevels->lists($language);
        $securityQuestions = $securityQuestions->lists($language);
        $currencies = $this->countries->lists('currency_code', 'id')->toArray();
        $sourcingNetworks = $sourcingNetworks->lists($language);
        $contacts = $contacts->lists($language);
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $positions = ActualPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $regions = Region::where('language_id', $language)->orderBy('name', 'asc')->lists('name', 'value_id')->all();
        $cases_numbers = CasesNumber::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $level_positions = LevelPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $jobTitle = Jobtitle::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();

        $industries_id = [];
        $industries_name = [];
        $region_id = [];
        $region_name = [];
        $type1_id = [];
        $type1_name = [];
        $type2_id = [];
        $type2_name = [];
        $type3_id = [];
        $type3_name = [];
        $type4_id = [];
        $type4_name = [];

        return view('user.add', compact('countries', 'roles', 'statuses', 'jobTitle',
            'regions',
            'type1_id',
            'type1_name',
            'type2_id',
            'type2_name',
            'type3_id',
            'type3_name',
            'type4_id',
            'type4_name',
            'industries_name',
            'industries_id',
            'region_name',
            'region_id',
            'cases_numbers',
            'level_positions',
            'positions',
            'searchTypeShared',
            'searchTypeInvolved',
            'opportunityInvolved',
            'opportunityShared',
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

        $dataUser = [
            'first_name'           => $request->first_name,
            'last_name'            => $request->last_name,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone,
            'country_id'           => $request->country_id,
            'confirmation_token'   => null,
            'password'             => $request->password,
            'status'               => $request->status
        ];
        // Username should be updated only if it is provided.
        // So, if it is an empty string, then we just leave it as it is.
        $user = $this->users->create($data);
        $this->users->updateSocialNetworks($user->id, []);
        $this->users->setRole($user->id, $request->get('role'));

        if($request->get('role') == 4 Or $request->get('role') == 5 Or $request->get('role') == 6){

            /*if($this->theUser->hasRole('AdminConsultant')){
                $dataCompany = [ 'is_active'  => true,
                          'created_at' => \Carbon\Carbon::now(),
                          'updated_at' => \Carbon\Carbon::now() ];

                $this->users->company($user->id)->attach($this->theUser->company_user->company_id, $dataCompany);
            }*/


            if(isset($request->password) && $request->password!=''){
                $dataUser['password'] = $request->password;
            }

            if(isset($address1)){
                $dataUser['address_id'] = $address1->id;
            }

            if((isset($request->state2) && $request->state2!='') && (isset($request->country_id2) && $request->country_id2!='')){
                $dataAddress2 = [
                    'city'       => $request->state2,
                    'address'    => $request->country_id2,
                    'is_active'  => 1];

                $address2 = $this->address->create($dataAddress2);
            }

            if(isset($request->company_name) && $request->company_name!=''){
                $dataCompany = ['name'                  => $request->company_name,
                    'comercial_name'        => $request->company_name,
                    'website'               => $request->website,
                    'quantity_employees_id' => $request->quantity_employees_id,
                    'is_active'             => 1,
                    'created_at'            => \Carbon\Carbon::now(),
                    'updated_at'            => \Carbon\Carbon::now(),
                    'category_id'           => 1
                ];

                if(isset($address2)){
                    $dataCompany['address_id'] = $address2->id;
                }

                if($company = CompanyUser::where('user_id', $user->id)->get()->first()){
                    $company = Company::find($company->company_id);
                    $company->update($dataCompany);
                } else {
                    $company = Company::create($dataCompany);
                }

                if(!$expe = Experience::where('company_id', $company->id)->get()->first()){
                    $expe = new Experience();
                    $expe->company_id = $company->id;
                    $expe->save();
                }

                if(!$profile = Profile::where('company_id', $company->id)->get()->first()){
                    $profile = new Profile();
                    $profile->company_id = $company->id;
                    $profile->actual_position_id = $request->actual_position_id;
                    $profile->linkedin_url = $request->linkedin;
                    $profile->years_experience_id = $request->years_experience_id;
                    $profile->jobtitle_id = $request->job_title_id;
                    $profile->current_company = $request->current_company;
                    $profile->user_id = $user->id;
                    if($request->reference_job==8){
                        $profile->reference_job = $request->reference_job;
                    } else {
                        $profile->reference_job = '';
                    }
                    $profile->save();
                } else {
                    $dt = ['linkedin_url' => $request->linkedin,
                        'current_company' => $request->current_company, 'user_id' => $user->id];
                    if(isset($request->years_experience_id) && $request->years_experience_id!=''){
                        $dt['years_experience_id'] = $request->years_experience_id;
                    }

                    if(isset($request->actual_position_id) && $request->actual_position_id!=''){
                        $dt['actual_position_id'] = $request->actual_position_id;
                    }

                    if(isset($request->job_title_id) && $request->job_title_id!=''){
                        $dt['jobtitle_id'] = $request->job_title_id;
                    }

                    if($request->job_title_id==8){
                        $dt['reference_job'] = $request->reference_job;
                    } else {
                        $dt['reference_job'] = '';
                    }
                    $profile->update($dt);
                }

                TypeSharedSearchProfile::where('profile_id', $profile->id)->delete();
                if(isset($request->searchType) && $request->searchType!=''){
                    $searchType = explode(',', $request->searchType);
                    foreach($searchType as $in){
                        TypeSharedSearchProfile::create(['profile_id' => $profile->id, 'type_of_shared_search_id' => $in]);
                    }
                }

                TypeSharedOpportunityProfile::where('profile_id', $profile->id)->delete();
                if(isset($request->searchTypeWork) && $request->searchTypeWork!=''){
                    $searchTypeWork = explode(',', $request->searchTypeWork);
                    foreach($searchTypeWork as $in){
                        TypeSharedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_shared_opportunities_id' => $in]);
                    }
                }

                TypeInvolvedSearchProfile::where('profile_id', $profile->id)->delete();
                if(isset($request->opportunityShare) && $request->opportunityShare!=''){
                    $opportunityShare = explode(',', $request->opportunityShare);
                    foreach($opportunityShare as $in){
                        TypeInvolvedSearchProfile::create(['profile_id' => $profile->id, 'type_of_involved_search_id' => $in]);
                    }
                }

                TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->delete();
                if(isset($request->opportunityInvolved) && $request->opportunityInvolved!=''){
                    $opportunityInvolved = explode(',', $request->opportunityInvolved);
                    foreach($opportunityInvolved as $in){
                        TypeInvolvedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_involved_opportunities_id' => $in]);
                    }
                }

                ExperienceIndustry::where('experience_id', $expe->id)->delete();
                if(isset($request->industries) && $request->industries!=''){
                    $industries = explode(',', $request->industries);
                    foreach($industries as $in){
                        ExperienceIndustry::create(['experience_id' => $expe->id, 'industry_id' => $in]);
                    }
                }

                ExperienceRegion::where('experience_id', $expe->id)->delete();
                if(isset($request->location) && $request->location!=''){
                    $location = explode(',', $request->location);
                    foreach($location as $in){
                        ExperienceRegion::create(['experience_id' => $expe->id, 'region_id' => $in]);
                    }
                }
                if(!CompanyUser::where('user_id', $user->id)->get()->first()){
                    $data = [ 'company_id' => $company->id,
                        'user_id'    => $user->id,
                        'is_active'  => true,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                        'position' => 1];

                    CompanyUser::create($data);
                    Point::create(['user_id' => $user->id, 'sum' => 25, 'company_id'=>$company->id]);
                }

                $dataLegal = [ 'user_id' => $user->id,
                    'legal_first_name'   => $request->first_name,
                    'legal_last_name'    => $request->last_name,
                    'legal_company_name' => $request->company_name,
                    'accept_terms_cond'  => $request->accept_terms_cond,
                    'created_at'         => \Carbon\Carbon::now(),
                    'updated_at'         => \Carbon\Carbon::now()
                ];

                if($le = LegalInformation::where('user_id', $user->id)->get()->first()){
                    $le->update($dataLegal);
                } else {
                    LegalInformation::create($dataLegal);
                }
            }

            $dataPreference = [ 'user_id'              => $user->id,
                'receive_messages'     => $request->receive_messages,
                'promotional_code'     => $request->promotional_code,
                'created_at'           => \Carbon\Carbon::now(),
                'updated_at'           => \Carbon\Carbon::now()
            ];

            if(isset($request->contact_id) && $request->contact_id!=''){
                $dataPreference['contact_id'] = $request->contact_id;
                if($request->contact_id==1 || $request->contact_id==4 || $request->contact_id==5){
                    $dataPreference['reference'] = $request->reference;
                } else {
                    $dataPreference['reference'] = '';
                }
            }

            if(isset($request->sourcing_networks_candidates_id) && $request->sourcing_networks_candidates_id!=''){
                $dataPreference['sourcing_network_id'] = $request->sourcing_networks_candidates_id;
            }

            if($preference = Preference::where('user_id', $user->id)->get()->first()){
                $preference->update($dataPreference);
            } else {
                Preference::create($dataPreference);
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
    public function edit(QuantityEmployeesRepository $quantityEmployees,
                         ExperienceYearRepository $experienceYears,
                         EducationLevelRepository $educationLevels,
                         SecurityQuestionRepository $securityQuestions,
                         SourcingNetworkRepository $sourcingNetworks,
                         ContactRepository $contacts,
                         FunctionalAreaRepository $functionalArea,
                         IndustryRepository $industries,
                         User $user,
                         CountryRepository $countryRepository,
                         RoleRepository $roleRepository)
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
        session(['lang' => \App::getLocale()]);
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }

        $searchTypeShared = TypeSharedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityShared = TypeInvolvedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $searchTypeInvolved = TypeSharedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityInvolved = TypeInvolvedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $quantityEmployees = $quantityEmployees->lists($language);
        $experienceYears = $experienceYears->lists($language);
        $educationLevels = $educationLevels->lists($language);
        $securityQuestions = $securityQuestions->lists($language);
        $currencies = $this->countries->lists('currency_code', 'id')->toArray();
        $sourcingNetworks = $sourcingNetworks->lists($language);
        $contacts = $contacts->lists($language);
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $positions = ActualPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $regions = Region::where('language_id', $language)->orderBy('name', 'asc')->lists('name', 'value_id')->all();
        $cases_numbers = CasesNumber::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $level_positions = LevelPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $jobTitle = Jobtitle::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();

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
        if($company!=''){
            $address = Address::find($company->address_id);
        } else {
            $address = '';
        }
        $expe = Experience::where('company_id', $user->company_user->company_id)->get()->first();
        $industries_id = [];
        $industries_name = [];
        $region_id = [];
        $region_name = [];
        $type1_id = [];
        $type1_name = [];
        $type2_id = [];
        $type2_name = [];
        $type3_id = [];
        $type3_name = [];
        $type4_id = [];
        $type4_name = [];
        if($expe){
            $indus = ExperienceIndustry::where('experience_id', $expe->id)->get();
            foreach($indus as $na){
                $industries_id[] = $na->industry_id;
                $industries_name[] = $na->industry($language)->name;
            }
            $funca = ExperienceRegion::where('experience_id', $expe->id)->get();
            foreach($funca as $na){
                $region_id[] = $na->region_id;
                $region_name[] = $na->region($language)->name;
            }
        }

        if($company!=''){
            $profile = Profile::where('company_id', $company->id)->get()->first();
            $funca = TypeSharedSearchProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type1_id[] = $na->type_of_shared_search_id;
                $type1_name[] = $na->name($language)->name;
            }
            $funca = TypeSharedOpportunityProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type2_id[] = $na->type_of_shared_opportunities_id;
                $type2_name[] = $na->name($language)->name;
            }

            $funca = TypeInvolvedSearchProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type3_id[] = $na->type_of_involved_search_id;
                $type3_name[] = $na->name($language)->name;
            }
            $funca = TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type4_id[] = $na->type_of_involved_opportunities_id;
                $type4_name[] = $na->name($language)->name;
            }
        } else{
            $profile = '';
        }
        try{
            $preferences = Preference::where('user_id', $user->id)->get()->first();
        } catch (\Exception $e){
            $preferences = '';
        }
        return view('user.edit',
            compact('edit',
                'user',
                'countries',
                'socials',
                'socialLogins',
                'roles',
                'statuses',
                'user',
                'jobTitle',
                'type1_id',
                'type1_name',
                'type2_id',
                'type2_name',
                'type3_id',
                'type3_name',
                'type4_id',
                'type4_name',
                'address',
                'legal',
                'profile',
                'regions',
                'preferences',
                'token',
                'industries_name',
                'industries_id',
                'region_name',
                'region_id',
                'cases_numbers',
                'level_positions',
                'positions',
                'searchTypeShared',
                'searchTypeInvolved',
                'opportunityInvolved',
                'opportunityShared',
                'company',
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

    public function update(User $user, Request $request)
    {

        $dataUser = [
            'first_name'           => $request->first_name,
            'last_name'            => $request->last_name,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone,
            'country_id'           => $request->country_id,
            'confirmation_token'   => null,
            'status'               => $request->status
        ];

        if(isset($request->password) && $request->password!=''){
            $dataUser['password'] = $request->password;
        }

        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        $this->users->update($user->id, $dataUser);
        $this->users->setRole($user->id, $request->get('role'));

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userIsBanned($user, $request)) {
            event(new Banned($user));
        }

        if((isset($request->state2) && $request->state2!='') && (isset($request->country_id2) && $request->country_id2!='')){
            $dataAddress2 = [
                'city'       => $request->state2,
                'address'    => $request->country_id2,
                'is_active'  => 1];

            $address2 = $this->address->create($dataAddress2);
        }

        if(isset($request->company_name) && $request->company_name!=''){
            $dataCompany = ['name'                  => $request->company_name,
                'comercial_name'        => $request->company_name,
                'website'               => $request->website,
                'quantity_employees_id' => $request->quantity_employees_id,
                'is_active'             => 1,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now(),
                'category_id'           => 1
            ];

            if(isset($address2)){
                $dataCompany['address_id'] = $address2->id;
            }

            if($company = CompanyUser::where('user_id', $user->id)->get()->first()){
                $company = Company::find($company->company_id);
                $company->update($dataCompany);
            } else {
                $company = Company::create($dataCompany);
            }

            if(!$expe = Experience::where('company_id', $company->id)->get()->first()){
                $expe = new Experience();
                $expe->company_id = $company->id;
                $expe->save();
            }

            if(!$profile = Profile::where('company_id', $company->id)->get()->first()){
                $profile = new Profile();
                $profile->company_id = $company->id;
                $profile->actual_position_id = $request->actual_position_id;
                $profile->linkedin_url = $request->linkedin;
                $profile->years_experience_id = $request->years_experience_id;
                $profile->jobtitle_id = $request->job_title_id;
                $profile->current_company = $request->current_company;
                $profile->user_id = $user->id;
                if($request->reference_job==8){
                    $profile->reference_job = $request->reference_job;
                } else {
                    $profile->reference_job = '';
                }
                $profile->save();
            } else {
                $dt = ['linkedin_url' => $request->linkedin,
                    'current_company' => $request->current_company, 'user_id' => $user->id];
                if(isset($request->years_experience_id) && $request->years_experience_id!=''){
                    $dt['years_experience_id'] = $request->years_experience_id;
                }

                if(isset($request->actual_position_id) && $request->actual_position_id!=''){
                    $dt['actual_position_id'] = $request->actual_position_id;
                }

                if(isset($request->job_title_id) && $request->job_title_id!=''){
                    $dt['jobtitle_id'] = $request->job_title_id;
                }

                if($request->job_title_id==8){
                    $dt['reference_job'] = $request->reference_job;
                } else {
                    $dt['reference_job'] = '';
                }
                $profile->update($dt);
            }

            TypeSharedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchType) && $request->searchType!=''){
                $searchType = explode(',', $request->searchType);
                foreach($searchType as $in){
                    TypeSharedSearchProfile::create(['profile_id' => $profile->id, 'type_of_shared_search_id' => $in]);
                }
            }

            TypeSharedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchTypeWork) && $request->searchTypeWork!=''){
                $searchTypeWork = explode(',', $request->searchTypeWork);
                foreach($searchTypeWork as $in){
                    TypeSharedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_shared_opportunities_id' => $in]);
                }
            }

            TypeInvolvedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityShare) && $request->opportunityShare!=''){
                $opportunityShare = explode(',', $request->opportunityShare);
                foreach($opportunityShare as $in){
                    TypeInvolvedSearchProfile::create(['profile_id' => $profile->id, 'type_of_involved_search_id' => $in]);
                }
            }

            TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityInvolved) && $request->opportunityInvolved!=''){
                $opportunityInvolved = explode(',', $request->opportunityInvolved);
                foreach($opportunityInvolved as $in){
                    TypeInvolvedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_involved_opportunities_id' => $in]);
                }
            }

            ExperienceIndustry::where('experience_id', $expe->id)->delete();
            if(isset($request->industries) && $request->industries!=''){
                $industries = explode(',', $request->industries);
                foreach($industries as $in){
                    ExperienceIndustry::create(['experience_id' => $expe->id, 'industry_id' => $in]);
                }
            }

            ExperienceRegion::where('experience_id', $expe->id)->delete();
            if(isset($request->location) && $request->location!=''){
                $location = explode(',', $request->location);
                foreach($location as $in){
                    ExperienceRegion::create(['experience_id' => $expe->id, 'region_id' => $in]);
                }
            }
            if(!CompanyUser::where('user_id', $user->id)->get()->first()){
                $data = [ 'company_id' => $company->id,
                    'user_id'    => $user->id,
                    'is_active'  => true,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'position' => 1];

                CompanyUser::create($data);
                Point::create(['user_id' => $user->id, 'sum' => 25, 'company_id'=>$company->id]);
            }

            $dataLegal = [ 'user_id' => $user->id,
                'legal_first_name'   => $request->first_name,
                'legal_last_name'    => $request->last_name,
                'legal_company_name' => $request->company_name,
                'accept_terms_cond'  => $request->accept_terms_cond,
                'created_at'         => \Carbon\Carbon::now(),
                'updated_at'         => \Carbon\Carbon::now()
            ];

            if($le = LegalInformation::where('user_id', $user->id)->get()->first()){
                $le->update($dataLegal);
            } else {
                LegalInformation::create($dataLegal);
            }
        }

        $dataPreference = [ 'user_id'              => $user->id,
            'receive_messages'     => $request->receive_messages,
            'promotional_code'     => $request->promotional_code,
            'created_at'           => \Carbon\Carbon::now(),
            'updated_at'           => \Carbon\Carbon::now()
        ];


        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
            if($request->contact_id==1 || $request->contact_id==4 || $request->contact_id==5){
                $dataPreference['reference'] = $request->reference;
            } else {
                $dataPreference['reference'] = '';
            }
        }

        if(isset($request->sourcing_networks_candidates_id) && $request->sourcing_networks_candidates_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_networks_candidates_id;
        }

        if($preference = Preference::where('user_id', $user->id)->get()->first()){
            $preference->update($dataPreference);
        } else {
            Preference::create($dataPreference);
        }

        return redirect()->route('user.index')
            ->withSuccess(trans('app.user_updated'));
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
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }

        $searchTypeShared = TypeSharedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityShared = TypeInvolvedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $searchTypeInvolved = TypeSharedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $opportunityInvolved = TypeInvolvedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
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
        $positions = ActualPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $regions = Region::where('language_id', $language)->orderBy('name', 'asc')->lists('name', 'value_id')->all();
        $cases_numbers = CasesNumber::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $level_positions = LevelPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
        $jobTitle = Jobtitle::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();

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
        if($company!=''){
            $address = Address::find($company->address_id);
        } else {
            $address = '';
        }
        $expe = Experience::where('company_id', $user->company_user->company_id)->get()->first();
        $industries_id = [];
        $industries_name = [];
        $region_id = [];
        $region_name = [];
        $type1_id = [];
        $type1_name = [];
        $type2_id = [];
        $type2_name = [];
        $type3_id = [];
        $type3_name = [];
        $type4_id = [];
        $type4_name = [];
        if($expe){
            $indus = ExperienceIndustry::where('experience_id', $expe->id)->get();
            foreach($indus as $na){
                $industries_id[] = $na->industry_id;
                $industries_name[] = $na->industry($language)->name;
            }
            $funca = ExperienceRegion::where('experience_id', $expe->id)->get();
            foreach($funca as $na){
                $region_id[] = $na->region_id;
                $region_name[] = $na->region($language)->name;
            }
        }

        if($company!=''){
            $profile = Profile::where('company_id', $company->id)->get()->first();
            $funca = TypeSharedSearchProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type1_id[] = $na->type_of_shared_search_id;
                $type1_name[] = $na->name($language)->name;
            }
            $funca = TypeSharedOpportunityProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type2_id[] = $na->type_of_shared_opportunities_id;
                $type2_name[] = $na->name($language)->name;
            }

            $funca = TypeInvolvedSearchProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type3_id[] = $na->type_of_involved_search_id;
                $type3_name[] = $na->name($language)->name;
            }
            $funca = TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->get();
            foreach($funca as $na){
                $type4_id[] = $na->type_of_involved_opportunities_id;
                $type4_name[] = $na->name($language)->name;
            }
        } else{
            $profile = '';
        }
        try{
            $preferences = Preference::where('user_id', $user->id)->get()->first();
        } catch (\Exception $e){
            $preferences = '';
        }

        //if($user->company_user->position==1){
            return view('dashboard_user.profile.confirm', compact('user',
                'jobTitle',
                'type1_id',
                'type1_name',
                'type2_id',
                'type2_name',
                'type3_id',
                'type3_name',
                'type4_id',
                'type4_name',
                'address',
                'legal',
                'profile',
                'regions',
                'preferences',
                'token',
                'industries_name',
                'industries_id',
                'region_name',
                'region_id',
                'cases_numbers',
                'level_positions',
                'positions',
                'searchTypeShared',
                'searchTypeInvolved',
                'opportunityInvolved',
                'opportunityShared',
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
        /*} else {
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
        }*/
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

        $dataUser = ['first_name'  => $request->first_name,
            'last_name'            => $request->last_name,
            'email'                => $request->email,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone
        ];

        if(isset($request->password) && $request->password!=''){
            $dataUser['password'] = $request->password;
        }

        if($request->autoSave == 0){
            $dataUser['confirmation_token'] = null;
        }
        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        $this->users->update($user->id, $dataUser);

        if((isset($request->state2) && $request->state2!='') && (isset($request->country_id2) && $request->country_id2!='')){
            $dataAddress2 = [
                'city'       => $request->state2,
                'address'    => $request->country_id2,
                'is_active'  => 1];

            $address2 = $this->address->create($dataAddress2);
        }

        if(isset($request->company_name) && $request->company_name!=''){
            $dataCompany = ['name'                  => $request->company_name,
                'comercial_name'        => $request->company_name,
                'website'               => $request->website,
                'quantity_employees_id' => $request->quantity_employees_id,
                'is_active'             => 1,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now(),
                'category_id'           => 1
            ];

            if(isset($address2)){
                $dataCompany['address_id'] = $address2->id;
            }

            if($company = CompanyUser::where('user_id', $user->id)->get()->first()){
                $company = Company::find($company->company_id);
                $company->update($dataCompany);
            } else {
                $company = Company::create($dataCompany);
            }

            if(!$expe = Experience::where('company_id', $company->id)->get()->first()){
                $expe = new Experience();
                $expe->company_id = $company->id;
                $expe->save();
            }

            if(!$profile = Profile::where('company_id', $company->id)->get()->first()){
                $profile = new Profile();
                $profile->company_id = $company->id;
                $profile->actual_position_id = $request->actual_position_id;
                $profile->linkedin_url = $request->linkedin;
                $profile->years_experience_id = $request->years_experience_id;
                $profile->jobtitle_id = $request->job_title_id;
                $profile->current_company = $request->current_company;
                $profile->user_id = $user->id;
                if($request->reference_job==8){
                    $profile->reference_job = $request->reference_job;
                } else {
                    $profile->reference_job = '';
                }
                $profile->save();
            } else {
                $dt = ['linkedin_url' => $request->linkedin,
                    'current_company' => $request->current_company, 'user_id' => $user->id];
                if(isset($request->years_experience_id) && $request->years_experience_id!=''){
                    $dt['years_experience_id'] = $request->years_experience_id;
                }

                if(isset($request->actual_position_id) && $request->actual_position_id!=''){
                    $dt['actual_position_id'] = $request->actual_position_id;
                }

                if(isset($request->job_title_id) && $request->job_title_id!=''){
                    $dt['jobtitle_id'] = $request->job_title_id;
                }

                if($request->job_title_id==8){
                    $dt['reference_job'] = $request->reference_job;
                } else {
                    $dt['reference_job'] = '';
                }
                $profile->update($dt);
            }

            TypeSharedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchType) && $request->searchType!=''){
                $searchType = explode(',', $request->searchType);
                foreach($searchType as $in){
                    TypeSharedSearchProfile::create(['profile_id' => $profile->id, 'type_of_shared_search_id' => $in]);
                }
            }

            TypeSharedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchTypeWork) && $request->searchTypeWork!=''){
                $searchTypeWork = explode(',', $request->searchTypeWork);
                foreach($searchTypeWork as $in){
                    TypeSharedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_shared_opportunities_id' => $in]);
                }
            }

            TypeInvolvedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityShare) && $request->opportunityShare!=''){
                $opportunityShare = explode(',', $request->opportunityShare);
                foreach($opportunityShare as $in){
                    TypeInvolvedSearchProfile::create(['profile_id' => $profile->id, 'type_of_involved_search_id' => $in]);
                }
            }

            TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityInvolved) && $request->opportunityInvolved!=''){
                $opportunityInvolved = explode(',', $request->opportunityInvolved);
                foreach($opportunityInvolved as $in){
                    TypeInvolvedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_involved_opportunities_id' => $in]);
                }
            }

            ExperienceIndustry::where('experience_id', $expe->id)->delete();
            if(isset($request->industries) && $request->industries!=''){
                $industries = explode(',', $request->industries);
                foreach($industries as $in){
                    ExperienceIndustry::create(['experience_id' => $expe->id, 'industry_id' => $in]);
                }
            }

            ExperienceRegion::where('experience_id', $expe->id)->delete();
            if(isset($request->location) && $request->location!=''){
                $location = explode(',', $request->location);
                foreach($location as $in){
                    ExperienceRegion::create(['experience_id' => $expe->id, 'region_id' => $in]);
                }
            }
            if(!CompanyUser::where('user_id', $user->id)->get()->first()){
                $data = [ 'company_id' => $company->id,
                    'user_id'    => $user->id,
                    'is_active'  => true,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'position' => 1];

                CompanyUser::create($data);
                Point::create(['user_id' => $user->id, 'sum' => 25, 'company_id'=>$company->id]);
            }

            $dataLegal = [ 'user_id' => $user->id,
                'legal_first_name'   => $request->first_name,
                'legal_last_name'    => $request->last_name,
                'legal_company_name' => $request->company_name,
                'accept_terms_cond'  => $request->accept_terms_cond,
                'created_at'         => \Carbon\Carbon::now(),
                'updated_at'         => \Carbon\Carbon::now()
            ];

            if($le = LegalInformation::where('user_id', $user->id)->get()->first()){
                $le->update($dataLegal);
            } else {
                LegalInformation::create($dataLegal);
            }
        }

        $dataPreference = [ 'user_id'              => $user->id,
            'receive_messages'     => $request->receive_messages,
            'promotional_code'     => $request->promotional_code,
            'created_at'           => \Carbon\Carbon::now(),
            'updated_at'           => \Carbon\Carbon::now()
        ];


        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
            if($request->contact_id==1 || $request->contact_id==4 || $request->contact_id==5){
                $dataPreference['reference'] = $request->reference;
            } else {
                $dataPreference['reference'] = '';
            }
        }

        if(isset($request->sourcing_networks_candidates_id) && $request->sourcing_networks_candidates_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_networks_candidates_id;
        }

        if($preference = Preference::where('user_id', $user->id)->get()->first()){
            $preference->update($dataPreference);
        } else {
            Preference::create($dataPreference);
        }

        if($request->autoSave=='1'){
            return response()->json(['success' => true], 200);
        } else {
            return redirect()->back()
                ->withSuccess(trans('app.update_profile_success'));
        }
    }
}