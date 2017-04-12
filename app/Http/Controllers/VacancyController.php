<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Vanguard\Events\User\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\ActualPosition;
use Vanguard\Candidate;
use Vanguard\ContractType;
use Vanguard\Conversation;
use Vanguard\Events\Vacancy\Viewed;
use Vanguard\Events\Vacancy\Logged;
use Vanguard\Events\Vacancy\Applied;
use Vanguard\Events\NotificationEvent;
use Vanguard\ExperienceYear;
use Vanguard\FunctionalArea;
use Vanguard\VacancyViewed;
use Vanguard\Http\Requests\Vacancy\CreateVacancyRequest;
use Vanguard\Http\Requests\Vacancy\UpdateVacancyRequest;
use Vanguard\Notification;
use Vanguard\ReplacementPeriod;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
use Vanguard\Repositories\ReplacementPeriod\ReplacementPeriodRepository;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Vanguard\Repositories\Vacancy\VacancyLogRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\SchemeWork\SchemeWorkRepository;
use Vanguard\Repositories\ContractType\ContractTypeRepository;
use Vanguard\Repositories\VacancyStatus\VacancyStatusRepository;
use Vanguard\Repositories\Address\AddressRepository;
use Vanguard\Repositories\AddressType\AddressTypeRepository;
use Vanguard\Repositories\Language\LanguageRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Condition\ConditionRepository;
use Vanguard\Repositories\Candidate\CandidateRepository;
use Vanguard\Repositories\Invoice\InvoiceRepository;
use Vanguard\Repositories\VacancyUser\VacancyUserRepository;
use Vanguard\Repositories\CompanyUser\CompanyUserRepository;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\VacancyViewedRepository;
use Vanguard\Repositories\VacancyCandidatesStatusRepository;
use Vanguard\Services\Upload\FileManager;
use Vanguard\Support\Enum\InvoiceStatus;
use Vanguard\Support\Enum\GeneralStatus;
use Vanguard\Http\Requests;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;
use Vanguard\Vacancy;
use Vanguard\VacancyCandidate;
use Vanguard\VacancyUser;
use Vanguard\CompanyUser;
use Vanguard\Testimonial;
use Vanguard\Point;
use JavaScript;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

use Vanguard\Http\Requests\Auth\RegisterRequest;
use Vanguard\Mailers\InvitationMailer;
use Vanguard\Repositories\Role\RoleRepository;

class VacancyController extends Controller
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
     * @var CountryRepository
     */
    private $countries;
    /**
     * @var AddressRepository
     */
    private $address;
    /**
     * @var VacancyRepository
     */
    private $vacancies;
    /**
     * @var ConditionRepository
     */
    private $conditions;
    /**
     * @var CandidateRepository
     */
    private $candidates;
    /**
     * @var InvoiceRepository
     */
    private $invoices;
     /**
     * @var CompaniesRepository
     */
    private $companies;
    /**
     * @var VacanciesUserRepository
     */
    private $vacancies_users;
    /**
     * @var CompaniesUserRepository
     */
    private $companies_users;

    /**
     * @var ReplacementPeriodRepository
     */
    private $replacement_period;

    /**
     * @var VacancyViewedRepository
     */
    private $vacancy_viewed;

    /**
     * @var VacancyCandidatesStatusRepository
     */
    private $vacancy_candidates_status;

    /**
     * VacancyController constructor.
     * @param VacancyRepository $vacancies)
     */
    public function __construct(VacancyRepository $vacancies,
                                UserRepository $users, 
                                CountryRepository $countries,
                                AddressRepository $address,
                                ConditionRepository $conditions,
                                CandidateRepository $candidates,
                                InvoiceRepository $invoices, 
                                VacancyUserRepository $vacancies_users,
                                CompanyUserRepository $companies_users,
                                CompanyRepository $companies,
                                VacancyViewedRepository $vacancy_viewed,
                                VacancyCandidatesStatusRepository $vacancy_candidates_status)
    {
        //$this->middleware('permission:vacancies.view');
        $this->vacancies = $vacancies;
        $this->invoices = $invoices;
        $this->candidates = $candidates;
        $this->countries = $countries;
        $this->conditions = $conditions;
        $this->address = $address;
        $this->users = $users;
        $this->vacancies_users = $vacancies_users;
        $this->companies_users = $companies_users;
        $this->companies = $companies;
        $this->vacancy_viewed = $vacancy_viewed;
        $this->vacancy_candidates_status = $vacancy_candidates_status;
        $this->theUser = Auth::user();

        JavaScript::put([
            'nonSelectedText_' => trans('app.non_selected_text'),
            'nSelectedText_'   => trans('app.n_selected_text'),
            'allSelectedText_' => trans('app.all_Selected_text')
        ]);
    }

    /**
     * Display page with all available vacancies.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $perPage = 20;
        $vacancies = $this->vacancies->paginate($perPage, Input::get('search'), Input::get('status'));

    	return view('vacancy.index', compact('vacancies'));
    }

    /**
     * Display form for creating new vacancy.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create (SchemeWorkRepository $schemeWorks,
                            ContractTypeRepository $contractTypes,
                            VacancyStatusRepository $vacancyStatus, 
                            AddressTypeRepository $addressTypes, 
                            LanguageRepository $languages) 
    {
     
        if (session('lang') =='en'){
            $language = 2;
        }else{
           $language = 1; 
        }

      // 	$edit = false;
      //  $schemeWorks = $schemeWorks->lists($language);
     //   $contractTypes = $contractTypes->lists($language);
      //  $vacancyStatus = $vacancyStatus->lists($language);
      //  $addressTypes = $addressTypes->lists($language);
       // $countries = $this->countries->lists()->toArray();
        $languages = $languages->lists()->toArray();

      /*  return view('vacancy.add_edit', compact('edit', 
                                                'schemeWorks', 
                                                'contractTypes', 
                                                'vacancyStatus',
                                                'countries',
                                                'addressTypes',
                                                'languages'
                                                ));	*/
        return view('dashboard_user.post.add_post'); 

    }

    /**
     * Store newly created vacancy to database.
     *
     * @param CreateVacancyRequest $request
     * @return mixed
     */
    public function store (Request $request, FileManager $filemanager)
    {
    // Validación de campos(Pantalla Create)
     $this->validate($request,
            ['name'                     => 'required|min:6',
            'positions_number'          => 'required|numeric',
             'location'                   => 'required',
            'target_companies'          => 'required',
            'off_limits_companies'      => 'required',
            'responsabilities'          => 'required', 
            'required_experience'       => 'required',
            'key_position_questions'    => 'required'
            ] );

        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;

        $data = ['poster_user_id'    => $this->theUser->id,
              'name'                      => $request->name,
              'positions_number'          => $request->positions_number,
              'vacancy_status_id'         => 2,
              'target_companies'          => $request->target_companies,
              'location'                  => $request->location,
              'off_limits_companies'      => $request->off_limits_companies,
              'responsabilities'          => $request->responsabilities, 
              'required_experience'       => $request->required_experience,
              'key_position_questions'    => $request->key_position_questions,
              'contract_type_id'          => 1,
              'company_id'                => $company_id,
              'created_at'                => \Carbon\Carbon::now(),
              'updated_at'                => \Carbon\Carbon::now(),
                ];

      $vacancy = $this->vacancies->create($data);   
    
      //Guarda los Archivos en carpeta de docs y en BD
      $files= $request->file('files');
      $uploadcount = 1;
        foreach($files as $file) {
          if ($file){
            $destinationPath = public_path('upload/docs');
            $filename = sprintf(
                "%s.%s",
                md5(str_random() . time()),
                $file->getClientOriginalExtension()
            );
            $upload_success = $file->move($destinationPath, $filename);
           if ($uploadcount == 1){
                 $this->vacancies->update($vacancy->id, ['file_job_description' => $filename]);
              }else if ($uploadcount == 2){
                 $this->vacancies->update($vacancy->id, ['file_employer' => $filename]);
              }
        $uploadcount++;
        }
      } 
      
     
        $request->session()->put('vacancy', $vacancy);
        $request->session()->put('id', $vacancy->id);
    
    return redirect()->action('VacancyController@getVacancyStepOne');
    }


    public function getVacancyStepOne(Request $request, ContractTypeRepository $contractTypes, 
                            LanguageRepository $languages, ExperienceYearRepository $experience,
                            FunctionalAreaRepository $functionalArea, IndustryRepository $industries){

        if (session('lang') =='en'){
            $language = 2;
            $searchType = ['1'=>'Contingency', '2'=>'Retained'];
        }else{
           $language = 1;
           $searchType = ['1' => 'Contingencia', '2' => 'Retenido'];
        }
        $contractTypes = $contractTypes->lists($language);
        $experience = $experience->lists($language);
        $languages = $languages->lists()->toArray();
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $replacement_period = ReplacementPeriod::where('language_id',$language)->lists('name', 'value_id');
        return view('dashboard_user.post.post_step1',compact('replacement_period', 'contractTypes', 'languages', 'searchType', 'experience', 'functionalArea', 'industries') , ['vacancies' => $request->session()->get('vacancies')]);

    }


    public function postVacancyStepOne(Request $request)
    {

       $this->validate($request,[
                'contract_type_id'         => 'required|exists:contract_types,id',
                'industry'                 => 'required',
                'search_type'              => 'required', 
                'years_experience'         => 'required',
                'especialization_id'       => 'required|numeric', 
                'range_salary'             => 'required',
                'warranty_employer'        => 'required', 
                'replacement_period_id'    => 'required',
                'group1'                   => 'required',
                'fee'                      => 'required',
                'general_conditions'       => 'required',
                'terms'                    => 'required',
                ] 
                );

        $data = [      
                'contract_type_id'          => $request->contract_type_id, 
                'industry'                  => $request->industry,
                'search_type'               => $request->search_type, 
                'years_experience'          => $request->years_experience,
                'especialization_id'        => $request->especialization_id,
                'range_salary'             =>  $request->range_salary,
                'warranty_employer'         => $request->warranty_employer, 
                'general_conditions'        => $request->general_conditions,
                'replacement_period'        => $request->replacement_period_id,
                'fee'                       => $request->fee,
                'terms'                     => $request->terms,
                'created_at'                => \Carbon\Carbon::now(),
                'updated_at'                => \Carbon\Carbon::now(),
            ];
    if($request->group1=='%'){
        $data['group1'] = 1;
    } else {
        $data['group2'] = 1;
    }
   $vacancy_id= $request->session()->get('id');
   $this->vacancies->update($vacancy_id,$data);

   return view('dashboard_user.post.post_step2' , compact('vacancy_id'), ['vacancies' => $request->session()->get('vacancies')]);

    }

    /**
     * Display specified vacancy.
     *
     * @param VacancyRepository $vacancy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        $vacancy = $this->vacancies->find($id);
        if(!isset($vacancy))
            return redirect()->route('vacancies.index')->withErrors(trans('app.register_not_found'));
        if($this->theUser->hasRole('Admin')){
            return view('vacancy.view', compact('vacancy'));
        }else {
            $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
            $supliers_recommended = User::where('id','!=',Auth::user()->id)->whereNotExists(function($query) use($id){
                $query->select('vacancy_users.*')->from('vacancy_users')
                    ->where('vacancy_id', $id)->whereRaw('vg_vacancy_users.supplier_user_id = vg_users.id');
            })->whereHas('company_user', function($q) use($company_id){
                $q->where('company_id', '!=', $company_id);
            })->limit(3)->get();
            return view('dashboard_user.post.post_detail', compact('supliers_recommended', 'vacancy'));
        }
    }

    /**
     * Display for editing specified vacancy.
     *
     * @param VacancyRepository $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit (  $id,
                            SchemeWorkRepository $schemeWorks,
                            ContractTypeRepository $contractTypes,
                            VacancyStatusRepository $vacancyStatus, 
                            AddressTypeRepository $addressTypes, 
                            LanguageRepository $languages)
    { 
        $edit = true;
        $vacancy = $this->vacancies->find($id);

        if($vacancy->poster_user_id != $this->theUser->id And !$this->theUser->hasRole('Admin'))
            return redirect()->route('vacancies.index')
                ->withErrors(trans('app.only_edit_your_vacancies'));

        if (session('lang') =='en'){
            $language = 2;
        }else{
           $language = 1; 
        }

        $schemeWorks = $schemeWorks->lists($language);
        $contractTypes = $contractTypes->lists($language);
        $vacancyStatus = $vacancyStatus->lists($language);
        $addressTypes = $addressTypes->lists($language);
        $countries = $this->countries->lists()->toArray();
        $languages = $languages->lists()->toArray();
        $language_selected = $this->listSelected($vacancy->languages);

        if(!isset($vacancy))
                return redirect()->route('vacancies.index')
                    ->withErrors(trans('app.register_not_found'));

        return view('vacancy.add_edit', compact('edit', 
                                                'vacancy', 
                                                'schemeWorks', 
                                                'contractTypes', 
                                                'vacancyStatus',
                                                'countries',
                                                'addressTypes',
                                                'languages',
                                                'language_selected')); 
    }

    /**
     * Update specified vacancy with provided data.
     *
     * @param VacancyRepository $id
     * @param UpdateVacancyRequest $request
     * @return mixed
     */
    public function update (UpdateVacancyRequest $request, $id)
    {
        $dataAddress = ['address_type_id' => $request->address_type_id,
                        'address'         => $request->address,
                        'state_id'        => $request->state,
                        'zip_code'        => $request->zip_code,
                        'city'            => $request->city,
                        ];

        $this->vacancies->address($id)->update($dataAddress);

        $data =  $request->except(  'state',
                                    'zip_code', 
                                    'city', 
                                    'address', 
                                    'address_type_id',
                                    'general_condition',
                                    'approximate_total_billing',
                                    'comission',
                                    'warranty');

        $vacancy = $this->vacancies->update($id, $data);

        //Languages Sync
        $language_selected = $request->input('list_languages');
        if(isset($language_selected) And count($language_selected) > 0 )
            $this->vacancies->languages($id)->sync($language_selected);
        else
            $this->vacancies->languages($id)->detach();

        $name = '';
        if($request->file('file')){
            $name = $filemanager->uploadFile('vacancy', $id);
            $this->vacancies->update($id, ['file' => $name]);
        }

        $dataConditions = [ 'general_condition'         => $request->general_condition,
                            'approximate_total_billing' => $request->approximate_total_billing,
                            'comission'                 => $request->comission,
                            'warranty'                  => $request->warranty,
                            'created_at'                => \Carbon\Carbon::now(),
                            'updated_at'                => \Carbon\Carbon::now(),
                            ];

        $this->conditions->update($vacancy->condition->id, $dataConditions);

        event(new Logged($vacancy));

        return redirect()->route('vacancies.index')
            ->withSuccess(trans('app.vacancy_updated_successfully')); 
    }

    /**
     * Remove specified vacancy from system.
     *
     * @param VacancyRepository $vacancy
     * @return mixed
     */
    public function delete ($id) 
    {
        $vacancy = $this->vacancies->find($id);

        if(!isset($vacancy))
                return redirect()->route('vacancies.index')
                    ->withErrors(trans('app.register_not_found'));
        
        if($vacancy->poster_user_id != $this->theUser->id And !$this->theUser->hasRole('Admin'))
            return redirect()->route('vacancies.index')
                ->withErrors(trans('app.only_edit_your_vacancies'));
        
        $this->vacancies->delete($id);

        return redirect()->route('vacancies.index')
            ->withSuccess(trans('app.vacancy_deleted'));
    }

    public function listSelected($array){
        $result [] = '';
        foreach ($array as $object) {
            $result [] = $object->id;
        }
        return $result;
    }

     /**
     * getProvinceByCountry
     *
     * Gets provinces by country 
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getProvinceByCountry(Request $request)
    {
        $country = $this->countries->find($request->get('country'));
        
        return response()->json($country->states->toArray());
    }

    /**
     * To apply specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function apply($id)
    {
        $vacancy = $this->vacancies->find($id);

        //Check not be poster
        if($this->theUser->id == $vacancy->poster_user_id)
            return redirect()->back()
                    ->withErrors(trans('app.postulation_is_not_allowed'));
        
        //Check not been postulated before
        if($vacancy->postulate())
            return redirect()->back()
                    ->withErrors(trans('app.already_been_postulated'));

        //Check supplier number < 3
        if($vacancy->countApplicationByStatus(GeneralStatus::ACTIVE) >= 3)
            return redirect()->back()
                    ->withErrors(trans('app.full_vacancy'));        

        $data = [ 'status'      => GeneralStatus::UNCONFIRMED,
                  'is_active'   => true,
                  'comment'     => '',
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        //To Apply
        $this->vacancies->supplier($id)->attach($this->theUser->id, $data);
        event(new Applied ($vacancy));

        return redirect()->back()
            ->withSuccess(trans('app.has_applied_for_vacancy')); 
    }

    /**
     * Approbate supplier in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function approbateSupplier(Request $request, $id)
    {
        //id => vacancy
        $vacancy = $this->vacancies->find($id);
        $vacancy_users = $this->vacancies_users->where('vacancy_id', $id);
        if (count($vacancy_users)>0) {
          $this->vacancies_users->updateStatusSupplier($id,$vacancy_users->supplier_user_id,1);
        }
        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy_users->supplier_user_id, 'type' => 'approved_supplier_vacancy', 'name'=>$vacancy->name]));
        Notification::destroy($request->notification);
        Conversation::create(['sender_user_id' => Auth::user()->id, 'destinatary_user_id' => $vacancy_users->supplier_user_id,
        'vacancy_id' => $vacancy->id]);
        return redirect()->back()
            ->withSuccess(trans('app.approved_application')); 
    }

    /**
     * Reject supplier in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function rejectSupplier(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);

        $vacancy->updateStatusSupplier($request->supplier, GeneralStatus::REJECTED);

        event(new NotificationEvent(['element_id' => $vacancy->id,
           'user_id'=>$request->supplier, 'type' => 'rejected_supplier_vacancy', 'name'=>$vacancy->name]));
        if(isset($request->notification)){
            Notification::destroy($request->notification);
        }

        return redirect()->back()
            ->withSuccess(trans('app.reject_application'));
    }

    public function invitedSupplierExternal(Request $request, InvitationMailer $mailer, RoleRepository $roles, $id)
    {
        // Determine user status. User's status will be set to UNCONFIRMED
        // if he has to confirm his email or to ACTIVE if email confirmation is not required
        $status = settings('reg_email_confirmation')
            ? UserStatus::UNCONFIRMED
            : UserStatus::ACTIVE;

        // Add the user to database
        $user = $this->users->create(
            ['email' => $request->email,
            'password' => rand(0000, 9999),
            'status' => $status
            ]);

        $this->users->updateSocialNetworks($user->id, []);

        //change register user with consultant unverified role
        $role = $roles->findByName('ConsultantUnverified');
        $this->users->setRole($user->id, $role->id);

        // Check if email confirmation is required,
        // and if it does, send confirmation email to the user.
        if (settings('reg_email_confirmation')) {
            $this->sendEmailSupplier($mailer, $user, $request->message);
            $message = trans('app.account_create_confirm_email');
        } else {
            $message = trans('app.account_created_login');
        }

        event(new Registered($user));

        return redirect()->back()
            ->withSuccess(trans('app.invited_supplier'));
    }

    private function sendEmailSupplier(InvitationMailer $mailer, $user, $message)
    {
        $token = str_random(60);
        $this->users->update($user->id, ['confirmation_token' => $token]);
        $mailer->sendEmailSupplier($user, $token, $message);
    }

    public function invitedSupplier(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);

        if($vacancy->countApplicationByStatus(GeneralStatus::ACTIVE) >= 3)
            return redirect()->back()
                ->withErrors(trans('app.full_vacancy'));

        $data = [ 'status'      => GeneralStatus::UNCONFIRMED,
            'is_active'   => true,
            'comment'     => '',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now() ];

        //To Apply
        $this->vacancies->supplier($id)->attach($request->supplier, $data);

        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$request->supplier, 'type' => 'invited_supplier_vacancy', 'name'=>$vacancy->name]));

        return redirect()->back()
            ->withSuccess(trans('app.invited_supplier'));
    }


    public function approbateInvitedSupplier(Request $request, $id)
    {
        //id => vacancy
        $vacancy = $this->vacancies->find($id);

        $vacancy_users = VacancyUser::where('vacancy_id', $vacancy->id)
            ->where('supplier_user_id', $request->supplier)->get()->first();
        if ($vacancy_users) {
            $this->vacancies_users->updateStatusSupplier($id,$vacancy_users->supplier_user_id,1);
        }
        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy->poster_user_id, 'type' => 'approved_supplier_invited_vacancy', 'name'=>$vacancy->name]));
        Notification::destroy($request->notification);
        Conversation::create(['sender_user_id' =>  $vacancy->poster_user_id, 'destinatary_user_id' => $vacancy_users->supplier_user_id,
            'vacancy_id' => $vacancy->id]);
        return redirect()->back()
            ->withSuccess(trans('app.approved_application_invited'));
    }

    /**
     * Reject supplier in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function rejectInvitedSupplier(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);

        $vacancy->updateStatusSupplier($request->supplier, GeneralStatus::REJECTED);

        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy->poster_user_id, 'type' => 'rejected_supplier_invited_vacancy', 'name'=>$vacancy->name]));
        if(isset($request->notification)){
            Notification::destroy($request->notification);
        }

        return redirect()->back()
            ->withSuccess(trans('app.reject_application_invited'));
    }

    public function qualifySupplier(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);

        $data = [
            'recommended_user_id' => $request->supplier,
            'recommended_by_user_id' => Auth::user()->id,
            'testimony'             => $request->opinion,
            'type'                  => 'supplier',
            'vacancy_id'            => $vacancy->id,
            'point'                 => $request->rating,
            'is_active'             => 1
        ];

        Testimonial::create($data);

        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$request->supplier, 'type' => 'qualify_supplier_vacancy', 'name'=>$vacancy->name]));

        return redirect()->back()
            ->withSuccess(trans('app.qualify_supplier'));
    }


    /**
     * Approbate candidate in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */

    public function getHistory(Request $request, $id)
    {
        $history = $this->vacancy_candidates_status->search(['vacancy_id' => $request->vacancy, 'candidate_id' => $id])->get();
        $data = [];
        foreach($history as $his){
            $date = explode(' ', $his->created_at);
            $time = explode(':', $date[1]);
            $date = explode('-', $date[0]);
            $data[] = ['status' =>trans('app.'.$his->status),
                'created_at' => \Carbon\Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1], $time[2])->diffForHumans()];
        }
        return $data;
    }

    public function read (Request $request, $id)
    {
        $vacancy = $this->vacancies->find($request->vacancy);
        if(!$this->vacancy_candidates_status->search(['status'=>'read', 'candidate_id'=>$id, 'vacancy_id'=>$vacancy->id])->get()->first()){
            $vacancy->updateStatusCandidate($id, 'Read');
            return $this->vacancy_candidates_status->create(['candidate_id' =>$id,
                'vacancy_id'=>$vacancy->id, 'status'=>'read']);
        } else {
            return response()->json([]);
        }
    }


    public function approbateCandidate(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($request->vacancy);
        $return = $vacancy->updateStatusCandidate($id, GeneralStatus::ACTIVE);

        $candidate = $this->candidates->find($id);

        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$candidate->supplier_user_id, 'type' => 'approbate_supplier_candidate',
            'name'=>$candidate->first_name.' '.$candidate->last_name]));
        $this->vacancy_candidates_status->create(['candidate_id' =>$id,
            'vacancy_id'=>$vacancy->id, 'status'=>GeneralStatus::ACTIVE]);
        return redirect()->back()
            ->withSuccess(trans('app.approved_candidate'));
    }

    /**
     * Reject candidate in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function rejectCandidate(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($request->vacancy);

        $vacancy->updateStatusCandidate($id, GeneralStatus::REJECTED);

        $candidate = $this->candidates->find($id);

        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$candidate->supplier_user_id, 'type' => 'rejected_supplier_candidate',
            'name'=>$candidate->first_name.' '.$candidate->last_name]));
        $this->vacancy_candidates_status->create(['candidate_id' =>$id,
            'vacancy_id'=>$vacancy->id, 'status'=>GeneralStatus::REJECTED]);
        return redirect()->back()
            ->withSuccess(trans('app.rejected_candidate'));
    }

    /**
     * To apply specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function postulateCandidate(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);

        $data = [ 'status'      => GeneralStatus::UNCONFIRMED,
                  'comment'     => $request->comment,
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        //Postulate
        $candidates = explode(',',$request->candidates);
        foreach($candidates as $candidate){
            $vacancy_candidates = $this->vacancies->candidates($vacancy->id)->attach($candidate, $data);
            $this->vacancy_candidates_status->create(['candidate_id' =>$candidate,
                'vacancy_id'=>$vacancy->id, 'status'=>UserStatus::UNCONFIRMED]);
        }
        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy->poster_user_id, 'type' => 'request_supplier_candidates', 'name'=>$vacancy->name]));

        return redirect()->back()
            ->withSuccess(trans('app.candidates_send_success'));
    }

    //** Status Post-Vancancy (Approved Administrador)
    public function status($id){
      $vacancy = $this->vacancies->find($id);
        if ($vacancy->vacancy_status->language_id == 1){

             // Status Activa - Inactiva
        if ($vacancy->vacancy_status_id == 1) {
          $vacancy->update(['vacancy_status_id' => 3]);     
        }

        // Por Aprobrar - Aprobar
        if ($vacancy->vacancy_status_id == 2) {
          $vacancy->update(['vacancy_status_id' => 1]);
        }

      }else if ($vacancy->vacancy_status->language_id == 2){
               // Status Activa - Inactiva
            if ($vacancy->vacancy_status_id == 5) {
              $vacancy->update(['vacancy_status_id' => 7]);     
            }

            // Por Aprobrar - Aprobar
            if ($vacancy->vacancy_status_id == 6) {
              $vacancy->update(['vacancy_status_id' => 5]);
              // Status Inactiva- Activa
            }
        }

        return redirect()->route('vacancies.index')
            ->withSuccess(trans('app.vacancy_updated_successfully')); 
      }

    //** List Opportunites Available  
    public function listVacancies(Request $request, ContractTypeRepository $contractTypes,
                                  LanguageRepository $languages, ExperienceYearRepository $experience,
                                  FunctionalAreaRepository $functionalArea, IndustryRepository $industries)
    {
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }
        //$contractTypes = $contractTypes->lists($language);
        //$experience = $experience->lists($language);
        //$functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $user_id = Auth::user()->id;
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $perPage = 20;
        $data = $this->vacancies->search(Auth::user()->id, $perPage, $request->all());
        $vacanciesCount = $data['count'];
        $vacancies = $data['data'];
        $data = $request->all();
        //$vacancies = $this->vacancies->getOpportunities('poster_user_id',$this->theUser->id, $perPage);
        return view('dashboard_user.post.index', compact('data', 'industries','vacanciesCount','vacancies', 'viewed'));
    }

    //** Detail Opportunity Available
    public function show_post_user(Request $request, $id, User $users){
        $vacancy = $this->vacancies->find($id);
        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
        if(CompanyUser::where(['user_id' => $vacancy->poster_user_id])->get()->first()->company_id == $company_id){
            return redirect()->route('vacancies.show', $vacancy->id);
        }
        $userVacancy = [];
        $userSupplierPost = false;
        foreach(Auth::user()->vacancy as $vacancy){
            $userVacancy[] = $vacancy['id'];
            if($vacancy['id']==$id && $vacancy['pivot']['status']=='1'){
                $userSupplierPost = true;
            }
        }
        event(new Viewed($vacancy));
        if(!$this->vacancy_viewed->search(['user_id' => Auth::user()->id, 'vacancy_id' => $vacancy->id])->get()->first()){
            $this->vacancy_viewed->create(['vacancy_id' => $vacancy->id, 'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(), 'user_agent' => $this->getUserAgent($request)]);
        }
        if (isset($vacancy)) {
            if (session('lang') =='en'){
                $language = 2;
            }else{
                $language = 1;
            }
            $companies_users = $this->companies_users->where('user_id',$this->theUser->id);
            if ($companies_users){
              $companies  = $this->companies->find($companies_users->company_id);                
            }
            if(!$userSupplierPost){
                return view('dashboard_user.post.post_user',compact('userVacancy', 'vacancy','companies')) ;
            } else {
                $data = $this->getCandidatesSupplier(Auth::user()->id, $vacancy);
                $userCandidatesAvailable = $data['userCandidatesAvailable'];
                $userCandidatesProgress = $data['userCandidatesProgress'];
                $userCandidatesRejected = $data['userCandidatesRejected'];
                return view('dashboard_user.post.post_supplier',compact('userCandidatesRejected', 'userCandidatesProgress', 'userCandidatesAvailable','userVacancy', 'vacancy','companies')) ;
            }

        }
       return redirect()->action('VacancyController@list')
          ->withErrors(trans('app.register_not_found'));
    }

    public function getCandidatesSupplier($supplierId, $vacancy)
    {
        $users = Candidate::where('supplier_user_id', $supplierId)->get();
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $i = 0;
        $j = 0;
        $p = 0;
        foreach ($users as $can){
            if(!VacancyCandidate::where('candidate_id', $can->id)->where('vacancy_id', $vacancy->id)->get()->first()) {
                $data1[] = $can;
                $data1[$i]['actual_position'] = ActualPosition::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $i++;
            }
            if(VacancyCandidate::where('candidate_id', $can->id)->where('vacancy_id', $vacancy->id)->where('status','!=','Rejected')->get()->first()) {
                $data2[] = $can;
                $data2[$j]['actual_position'] = ActualPosition::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $j++;
            }
            if(VacancyCandidate::where('candidate_id', $can->id)->where('vacancy_id', $vacancy->id)->where('status','Rejected')->get()->first()) {
                $data3[] = $can;
                $data3[$p]['actual_position'] = ActualPosition::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $p++;
            }
        }
        return ['userCandidatesAvailable' =>  $data1, 'userCandidatesProgress' => $data2,
        'userCandidatesRejected' => $data3];
    }

    //** Request Supplier 
    public function post_supplier($id){
        $vacancy  = $this->vacancies->find($id);
        if ($vacancy){
        $data = [ 'vacancy_id'        => $id,
              'supplier_user_id'  => $this->theUser->id,
              'status'            => 0,
              'is_active'         => 0,
              'comment'           => '',
              'created_at'        => \Carbon\Carbon::now(),
              'updated_at'        => \Carbon\Carbon::now(),];
        $vacancy_user = $this->vacancies_users->create($data);
        event(new NotificationEvent(['element_id' => $vacancy_user->id,
            'user_id'=>$vacancy->poster_user_id, 'type' => 'request_supplier_vacancy', 'name'=>$vacancy->name]));
        return redirect()->back()
            ->withSuccess(trans('app.has_applied_for_vacancy'));
        }
    }

    public function getContractCandidate(Request $request, $id)
    {
        $vacancy  = $this->vacancies->find($id);
        $candidate = $this->candidates->find($request->candidate);
        return view('dashboard_user.post.contratar',compact('vacancy','candidate'));
    }

    public function postContractCandidate(Request $request, $id)
    {
        $data_admission = explode('/',$request->date_admision);
        $vacancy  = $this->vacancies->find($id);
        $candidate = $this->candidates->find($request->candidate);

        if($vacancy->isApprobateCandidate($candidate->id)){
            $data =['vacancy_id'       => $vacancy->id,
                'number'           => substr (microtime(), 12, 20),
                'name'             => $request->position,
                'date_of_admission' => $data_admission[2].'-'.$data_admission[1].'-'.$data_admission[0],
                'offer'             => $request->details,
                'candidate_id'      => $candidate->id,
                'amount' => $request->salario,
                //'tax'              => ($vacancy->condition->comission)/$vacancy->positions_number,
                'supplier_user_id' => $candidate->supplier_user_id,
                'poster_user_id'   => $vacancy->poster_user_id,
                'status'           => InvoiceStatus::PENDING,
                'payment_due'      => $vacancy->created_at->addDays(12)
            ];
            $this->invoices->create($data);
            //Vacancy Log
            //event(new Logged($vacancy, $candidate));
        }

        $data = [
            'recommended_user_id' => $candidate->supplier_user_id,
            'recommended_by_user_id' => Auth::user()->id,
            'testimony'             => $request->comments_supplier,
            'type'                  => 'supplier',
            'vacancy_id'            => $vacancy->id,
            'point'                 => $request->rating,
            'is_active'             => 1
        ];

        Testimonial::create($data);
        $vacancy_user = VacancyCandidate::where('vacancy_id', $vacancy->id)
            ->where('candidate_id', $candidate->id)->get()->first();
        event(new NotificationEvent(['element_id' => $vacancy_user->id,
            'user_id'=>$candidate->supplier_user_id, 'type' => 'qualify_supplier_vacancy_contract', 'name'=>$vacancy->name]));

        return redirect()->route('vacancies.show', $vacancy->id)
            ->withSuccess(trans('app.has_contract_candidate'));
    }

    /**
     * Get user agent from request headers.
     *
     * @return string
     */
    private function getUserAgent($request)
    {
        return substr((string) $request->header('User-Agent'), 0, 500);
    }

}
