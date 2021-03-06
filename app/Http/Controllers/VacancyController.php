<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Support\Facades\Lang;
use Vanguard\Balance;
use Vanguard\Compensation;
use Vanguard\Country;
use Vanguard\Events\User\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\ActualPositionCandidate;
use Vanguard\Candidate;
use Vanguard\Language;
use Vanguard\LanguageType;
use Vanguard\LanguageVacancy;
use Vanguard\Mailers\VacancyMailer;
use Vanguard\Services\Suppliers\SupplierManager;
use Vanguard\Services\Vacancies\VacancyManager;
use Vanguard\Setting;
use Vanguard\State;
use Vanguard\ContractType;
use Vanguard\Conversation;
use Vanguard\Events\Vacancy\Viewed;
use Vanguard\Events\Vacancy\Logged;
use Vanguard\Events\Vacancy\Applied;
use Vanguard\Events\NotificationEvent;
use Vanguard\Events\RankingEvent;
use Vanguard\ExperienceYear;
use Vanguard\FunctionalArea;
use Vanguard\UserInvited;
use Vanguard\VacancyCandidateStatus;
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
use Vanguard\Mailers\InterestedMailer;

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

    private $vacanciesManager;

    private $supplierManager;

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
                                VacancyCandidatesStatusRepository $vacancy_candidates_status,
                                VacancyManager $vacanciesManager,
                                SupplierManager $supplierManager)
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
        $this->vacanciesManager = $vacanciesManager;
        $this->supplierManager = $supplierManager;

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
                            LanguageRepository $languages, $id = null)
    {
        if (session('lang') =='en'){
            $language = 2;
        }else{
           $language = 1; 
        }
        $countries = Country::orderBy('name', 'asc')->lists('name', 'id');
        if($id!=null){
            $vacancy = $this->vacancies->find($id);
            if(Auth::user()->company[0]->id!=$vacancy->poster->company[0]->id){
                return redirect()->route('vacancies.post_user', $id);
            }
        } else {
            $vacancy = false;
        }
       	$edit = false;
        $schemeWorks = $schemeWorks->lists($language);
        $contractTypes = $contractTypes->lists($language);
        $vacancyStatus = $vacancyStatus->lists($language);
        $addressTypes = $addressTypes->lists($language);
        $countries = $this->countries->lists()->toArray();
        $languages = $languages->lists()->toArray();
        if($this->theUser->hasRole('Admin')){
            return view('vacancy.add_edit', compact('edit',
                'schemeWorks',
                'contractTypes',
                'vacancyStatus',
                'countries',
                'addressTypes',
                'languages'
            ));
        }
        return view('dashboard_user.post.add_post', compact('vacancy', 'countries'));

    }

    /**
     * Store newly created vacancy to database.
     *
     * @param CreateVacancyRequest $request
     * @return mixed
     */
    public function store (Request $request, FileManager $filemanager, $id = null)
    {
    // Validación de campos(Pantalla Create)
        $data_validate = ['name'        => 'required',
            'positions_number'          => 'required|numeric',
            'country_id'                => 'required',
            'state_id'                  => 'required',
            'responsabilities'          => 'required',
            'required_experience'       => 'required',
            'key_position_questions'    => 'required'
        ];
        if($id==null){
            $data_validate['job'] = 'required';
        }
     $this->validate($request,
            $data_validate,
            ['job.required' => Lang::get('app.job_description_required')]);

        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;

        $data = ['poster_user_id'    => $this->theUser->id,
              'name'                 => $request->name,
              'positions_number'     => $request->positions_number,
              'vacancy_status_id'    => 2,
              'target_companies'     => $request->target_companies,
              'location'             => $request->state_id,
              'country_id'           => $request->country_id,
              'state_id'             => $request->state_id,
              'city_id'              => $request->city_id,
              'off_limits_companies' => $request->off_limits_companies,
              'responsabilities'     => $request->responsabilities,
              'required_experience'  => $request->required_experience,
              'key_position_questions' => $request->key_position_questions,
              'contract_type_id'     => 1,
              'company_id'           => $company_id,
              'created_at'           => \Carbon\Carbon::now(),
              'updated_at'           => \Carbon\Carbon::now(),
                ];

        if($id!=null){
            $vacancy = $this->vacancies->find($id);
            $this->vacancies->update($vacancy->id, $data);
        } else {
            $vacancy = $this->vacancies->create($data);
        }
        if($request->file('job')){
               $name = $filemanager->uploadFile('vacancy', $vacancy->id, 'job');
               $this->vacancies->update($vacancy->id, ['file_job_description' => $name]);
        }

        if($request->file('employer')){
            $name = $filemanager->uploadFile('vacancy', $vacancy->id, 'employer');
            $this->vacancies->update($vacancy->id, ['file_employer' => $name]);
        }

        $request->session()->put('vacancy', $vacancy);
        $request->session()->put('id', $vacancy->id);
        if(isset($request->saveonly)){
            return redirect()->route('vacancies.show', $vacancy->id);
        }
        if($id!=null){
            return redirect()->route('vacancies.step1', $id);
        } else {
            return redirect()->action('VacancyController@getVacancyStepOne');
        }
    }


    public function getVacancyStepOne(Request $request, ContractTypeRepository $contractTypes, 
                            LanguageRepository $languages, ExperienceYearRepository $experience,
                            FunctionalAreaRepository $functionalArea, IndustryRepository $industries, $id = null){
        if (session('lang') =='en'){
            $language = 2;
            $searchType = ['1'=>'Contingency', '2'=>'Retained'];
        }else{
           $language = 1;
           $searchType = ['1' => 'Contingencia', '2' => 'Retenido'];
        }
        if($id!=null){
            $vacancy = $this->vacancies->find($id);
            if(Auth::user()->company[0]->id!=$vacancy->poster->company[0]->id){
                return redirect()->route('vacancies.post_user', $id);
            }
            $langs = LanguageVacancy::where('vacancy_id', $id)->get();
            $langc = [];
            foreach ($langs as $l){
                $langc[] = $l['type_id'].'-'.$l->type($language);
            }
        } else {
            $langs = false;
            $langc = [];
            $vacancy = false;
        }
        $lans = ['1' => \Lang::get('app.native'), '2' => \Lang::get('app.fluent'), '3' => \Lang::get('app.good'), '4' => \Lang::get('app.functional'), '5' => \Lang::get('app.basic')];
        $compensations = Compensation::orderBy('id', 'asc')->lists('salary', 'salary');
        $contractTypes = $contractTypes->lists($language);
        $experience = $experience->lists($language);
        $languages = [];
        foreach(LanguageType::where('language_id', $language)->get() as $lan){
            $languages[$lan['value_id'].'-'.$lan['name']] = $lan['name'];
        }
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $replacement_period = ['' => 'None'];
        foreach(ReplacementPeriod::where('language_id',$language)->get() as $re){
            $replacement_period[$re['value_id']] = $re['name'];
        }
        $vacancy_id = $request->session()->get('id');
        if(preg_match('/create/', $request->url())){
            $url = route('vacancies.create', $vacancy_id);
        } else {
            $url = route('vacancies.edit.front', $vacancy_id);
        }
        return view('dashboard_user.post.post_step1',compact('url', 'vacancy_id', 'language', 'lans', 'langs', 'langc', 'vacancy', 'compensations', 'replacement_period', 'contractTypes', 'languages', 'searchType', 'experience', 'functionalArea', 'industries') , ['vacancies' => $request->session()->get('vacancies')]);

    }

    public function getVacancyStepTwo(Request $request, ContractTypeRepository $contractTypes,
                                      LanguageRepository $languages, ExperienceYearRepository $experience,
                                      FunctionalAreaRepository $functionalArea, IndustryRepository $industries, $id = null){
        if (session('lang') =='en'){
            $language = 2;
            $searchType = ['1'=>'Contingency', '2'=>'Retained'];
        }else{
            $language = 1;
            $searchType = ['1' => 'Contingencia', '2' => 'Retenido'];
        }
        if($id!=null){
            $vacancy = $this->vacancies->find($id);
            if(Auth::user()->company[0]->id!=$vacancy->poster->company[0]->id){
                return redirect()->route('vacancies.post_user', $id);
            }
            $langs = LanguageVacancy::where('vacancy_id', $id)->get();
            $langc = [];
            foreach ($langs as $l){
                $langc[] = $l['type_id'].'-'.$l->type($language);
            }
        } else {
            $langs = false;
            $langc = [];
            $vacancy = false;
        }
        $lans = ['1' => \Lang::get('app.native'), '2' => \Lang::get('app.fluent'), '3' => \Lang::get('app.good'), '4' => \Lang::get('app.functional'), '5' => \Lang::get('app.basic')];
        $compensations = Compensation::orderBy('id', 'asc')->lists('salary', 'salary');
        $contractTypes = $contractTypes->lists($language);
        $experience = $experience->lists($language);
        $languages = [];
        foreach(LanguageType::where('language_id', $language)->get() as $lan){
            $languages[$lan['value_id'].'-'.$lan['name']] = $lan['name'];
        }
        $functionalArea = $functionalArea->lists($language);
        $industries = $industries->lists($language);
        $replacement_period = ['' => 'None'];
        foreach(ReplacementPeriod::where('language_id',$language)->get() as $re){
            $replacement_period[$re['value_id']] = $re['name'];
        }
        $vacancy_id = $id;
        $supliers_recommended = $this->supplierManager->getRecommended($id, 4, [], $vacancy_id);
        return view('dashboard_user.post.post_step2' , compact('vacancy_id', 'supliers_recommended'), ['vacancies' => $vacancy]);

    }

    public function postVacancyStepOneAjax(Request $request, $id)
    {
        $data = [];
        if(isset($request->contract_type_id)){
            $data['contract_type_id'] = $request->contract_type_id;
        }
        if(isset($request->industry)){
            $data['industry'] = $request->industry;
        }
        if(isset($request->search_type)){
            $data['search_type'] = $request->search_type;
        }
        if(isset($request->years_experience)){
            $data['years_experience'] = $request->years_experience;
        }
        if(isset($request->especialization_id)){
            $data['especialization_id'] = $request->especialization_id;
        }
        if(isset($request->range_salary)){
            $data['range_salary'] = $request->range_salary;
        }
        if(isset($request->warranty_employer)){
            $data['warranty_employer'] = $request->warranty_employer;
        }
        if(isset($request->general_conditions)){
            $data['general_conditions'] = $request->general_conditions;
        }
        if(isset($request->replacement_period_id)){
            $data['replacement_period_id'] = $request->replacement_period_id;
        }
        if(isset($request->fee)){
            $data['fee'] = $request->fee;
        }
        if(isset($request->group1)){
            $data['group1'] = $request->group1;
        }
        if(isset($request->terms)){
            $data['terms'] = $request->terms;
        }
        if(count($data)>0) {
            $data['vacancy_status_id'] = 1;
        }
        $this->vacancies->update($id,$data);
        LanguageVacancy::where('vacancy_id', $id)->delete();
        if(isset($request->list_languages)){
            foreach($request->list_languages as $lan){
                if($lan!=''){
                    $explode = explode('-', $lan);
                    LanguageVacancy::create(['level' => $request->all()['level-'.$explode[0]],
                        'type_id' => $explode[0], 'vacancy_id' =>$id]);
                }
            }
        }
        return response()->json(['sucess'=>'success'], 200);
    }

    public function postVacancyStepOne(Request $request, $id = null)
    {
       $this->validate($request,[
                'contract_type_id'         => 'required|exists:contract_types,id',
                'industry'                 => 'required',
                'search_type'              => 'required', 
                'years_experience'         => 'required',
                'especialization_id'       => 'required|numeric', 
                'range_salary'             => 'required',
                'group1'                   => 'required',
                'fee'                      => 'required',
                'terms'                    => 'required',
                ] ,
                ['terms.required' => Lang::get('app.terms_of_service_post')]
                );

        $data = [      
                'contract_type_id'          => $request->contract_type_id, 
                'industry'                  => $request->industry,
                'search_type'               => $request->search_type, 
                'years_experience'          => $request->years_experience,
                'especialization_id'        => $request->especialization_id,
                'range_salary'              =>  $request->range_salary,
                'warranty_employer'         => $request->warranty_employer, 
                'general_conditions'        => $request->general_conditions,
                'replacement_period_id'        => $request->replacement_period_id,
                'fee'                       => $request->fee,
                'group1'                    => $request->group1,
                'terms'                     => $request->terms,
                'created_at'                => \Carbon\Carbon::now(),
                'updated_at'                => \Carbon\Carbon::now(),
                'vacancy_status_id'         => 1
            ];

   $vacancy_id = $request->session()->get('id');
   $validate_first = $id;
   if($id!=null){
       $vacancy_id = $id;
   } else {
       $id = $vacancy_id;
   }
   $this->vacancies->update($vacancy_id,$data);
   LanguageVacancy::where('vacancy_id', $id)->delete();
   if(isset($request->list_languages)){
       foreach($request->list_languages as $lan){
           if($lan!=''){
               $explode = explode('-', $lan);
               LanguageVacancy::create(['level' => $request->all()['level-'.$explode[0]],
                   'type_id' => $explode[0], 'vacancy_id' =>$id]);
           }
       }
   }
   if($validate_first==null) {
       event(new RankingEvent(['user_id' => Auth::user()->id, 'points' => 25]));
   }
   if(isset($request->saveonly)){
       return redirect()->route('vacancies.show', $vacancy_id);
   }
   $supliers_recommended = $this->supplierManager->getRecommended($id, 4, [], $vacancy_id);
   return view('dashboard_user.post.post_step2' , compact('vacancy_id', 'supliers_recommended'), ['vacancies' => $request->session()->get('vacancies')]);

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
        if(Auth::user()->company[0]->id!=$vacancy->poster->company[0]->id){
            return redirect()->route('vacancies.post_user', $id);
        }
        if(!isset($vacancy))
            return redirect()->route('vacancies.index')->withErrors(trans('app.register_not_found'));
        if($this->theUser->hasRole('Admin')){
            return view('vacancy.view', compact('vacancy'));
        }else {
            $supliers_interesting = $this->supplierManager->getPostInteresting($id);
            $supliers_recommended = $this->supplierManager->getRecommended($id, 3, [], $vacancy->id);
            return view('dashboard_user.post.post_detail', compact('supliers_interesting', 'supliers_recommended', 'vacancy'));
        }
    }

    public function getSupplierRecommended(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);
        $supliers_recommended = $this->supplierManager->getRecommended($id, 1, explode(',',$request->exclude, $vacancy->id));
        $html = view('dashboard_user.post.partials.suppliersrecommended', ['supliers_recommended' => $supliers_recommended,
            'vacancy' => $vacancy]);
        $html = $html->render();
        return response()->json(['data' => $supliers_recommended, 'html' => $html]);
    }

    /**
     * Display for editing specified vacancy.
     *
     * @param VacancyRepository $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showVacancy(  $id,
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

        return view('vacancy.view', compact('edit',
            'vacancy',
            'schemeWorks',
            'contractTypes',
            'vacancyStatus',
            'countries',
            'addressTypes',
            'languages',
            'language_selected'));
    }

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
        if($vacancy->countApplicationByStatus(1) >= 3)
            return redirect()->back()
                ->withErrors(trans('app.full_vacancy'));
        $vacancy_users = VacancyUser::where('vacancy_id', $id)
            ->where('supplier_user_id', $request->supplier)->get()->first();
        if (count($vacancy_users)>0) {
          $this->vacancies_users->updateStatusSupplier($id,$vacancy_users->supplier_user_id,1);
        }
        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy_users->supplier_user_id, 'type' => 'approved_supplier_vacancy', 'name'=>$vacancy->name]));
        if(isset($request->notification) && $request->notification!=''){
            Notification::destroy($request->notification);
        }
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
        $conversation = Conversation::where('sender_user_id', $vacancy->poster_user_id)
        ->where('destinatary_user_id', $request->supplier)->where('vacancy_id', $vacancy->id)->get()->first();

        if($conversation){
            $conversation->delete();
        }

        return redirect()->back()
            ->withSuccess(trans('app.reject_application'));
    }

    public function invitedSupplierExternal(Request $request, InvitationMailer $mailer, RoleRepository $roles, $id)
    {

        if(User::where('email', $request->email)->get()->first()){
            return redirect()->back()
                ->withErrors(trans('app.collaborator_register'));
        }
        // Determine user status. User's status will be set to UNCONFIRMED
        // if he has to confirm his email or to ACTIVE if email confirmation is not required
        $status = settings('reg_email_confirmation')
            ? UserStatus::UNCONFIRMED
            : UserStatus::ACTIVE;
        // Add the user to database
        $user = $this->users->create(
            ['email' => $request->email,
            'password' => rand(0000, 9999),
            'status' => $status,
            'code'   => $this->generateCode()
            ]);

        $this->users->updateSocialNetworks($user->id, []);

        //change register user with consultant unverified role
        $role = $roles->findByName('ConsultantUnverified');
        $this->users->setRole($user->id, $role->id);
        $codePromotional = $this->createCode(Auth::user()->id, $user->id, $id);

        // Check if email confirmation is required,
        // and if it does, send confirmation email to the user.
        if (settings('reg_email_confirmation')) {
            $this->sendEmailSupplier($mailer, $user, $request->message, $codePromotional);
            $message = trans('app.account_create_confirm_email');
        } else {
            $message = trans('app.account_created_login');
        }

        event(new Registered($user));

        return redirect()->back()
            ->withSuccess(trans('app.invited_supplier'));
    }

    public function generateCode()
    {
        $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z'];

        $rand = '';
        for($i = 0; $i<4; $i++){
            $rand .= $letras[rand(0, count($letras)-1)];
        }
        while(User::where('code', $rand)->get()->first()){
            $rand = '';
            for($i = 0; $i<4; $i++){
                $rand .= $letras[rand(0, count($letras)-1)];
            }
        }
        return $rand;
    }

    public function createCode($user_create, $user_destiny, $vacancy)
    {
        $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z'];

        $rand = '';
        for($i = 0; $i<4; $i++){
            $rand .= $letras[rand(0, count($letras)-1)];
        }
        while(UserInvited::where('code', $rand)->get()->first()){
            $rand = '';
            for($i = 0; $i<4; $i++){
                $rand .= $letras[rand(0, count($letras)-1)];
            }
        }
        UserInvited::create(['user_id' => $user_create, 'user_invited_id' => $user_destiny,
        'code' => $rand, 'status' => 1, 'vacancy_id' => $vacancy]);
        return $rand;
    }

    private function sendEmailSupplier(InvitationMailer $mailer, $user, $mess, $code)
    {
        $token = str_random(60);
        $this->users->update($user->id, ['confirmation_token' => $token]);
        $mailer->sendEmailSupplier($user, $token, $mess, $code);
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

        if(isset($request->view)){
            return redirect()->route('vacancies.show', $id)
                ->withSuccess(trans('app.invited_supplier'));
        }

        if(isset($request->view2)){
            return redirect()->route('vacancies.step2', $id)
                ->withSuccess(trans('app.invited_supplier'));
        }

        return redirect()->back()
            ->withSuccess(trans('app.invited_supplier'));
    }


    public function approbateInvitedSupplier(Request $request, $id)
    {
        //id => vacancy
        $vacancy = $this->vacancies->find($id);
        if($vacancy->countApplicationByStatus(1) >= 3)
            return redirect()->back()
                ->withErrors(trans('app.full_vacancy'));
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
        $rating = ['1' => -10, '2' => 0, '3' => 5, '4' => 10, '5' => 20];
        event(new RankingEvent(['user_id' => $request->supplier, 'points' => $rating[$request->rating.'']]));
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

    public function change_status_candidate(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($id);
        $return = $vacancy->updateStatusCandidate($request->candidate, $request->status);

        $this->vacancy_candidates_status->create(['candidate_id' =>$request->candidate,
            'vacancy_id'=>$vacancy->id, 'status'=>$request->status]);
        return redirect()->back()
            ->withSuccess(trans('app.status_change_candidate'));
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
        event(new RankingEvent(['user_id' => $candidate->supplier_user_id, 'points' => 5]));
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

    public function deleteCandidate(Request $request, $id)
    {
        $vacancy = $this->vacancies->find($request->vacancy);

        $vacancy->updateStatusCandidate($id, 'Deleted');

        $this->vacancy_candidates_status->create(['candidate_id' =>$id,
            'vacancy_id'=>$vacancy->id, 'status'=> 'Deleted']);
        return redirect()->back()
            ->withSuccess(trans('app.deleted_candidate'));
    }

    /**
     * To apply specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function postulateCandidate(Request $request, $id)
    {
        if(isset($request->typ) && $request->typ==1){
            $credits = Balance::where('company_id', \Auth::user()->company_user->company_id)->sum('credit');
            $credits_candidates = Setting::where('key', 'candidate_price')->get()->first()->value;
            if($credits_candidates > $credits){
                return redirect()->back()->withErrors(trans('app.error_message_send_candidates_money2'));
            }
        }

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
        if(isset($request->typ) && $request->typ==1) {
            Balance::create(['company_id' => \Auth::user()->company_user->company_id, 'credit' => '-'.$credits_candidates,
                'status'=> 3]);
            Conversation::create(['sender_user_id' => $vacancy->poster_user_id, 'destinatary_user_id' => Auth::user()->id,
                        'vacancy_id' => $vacancy->id]);
        }
        event(new NotificationEvent(['element_id' => $vacancy->id,
            'user_id'=>$vacancy->poster_user_id, 'type' => 'request_supplier_candidates', 'name'=>$vacancy->name]));

        return redirect()->back()
            ->withSuccess(trans('app.candidates_send_success'));
    }

    //** Status Post-Vancancy (Approved Administrador)
    public function change_status(Request $request, VacancyMailer $mailer){
        $vacancy = $this->vacancies->find($request->vacancy);
        $vacancy->update(['vacancy_status_id' => $request->status]);
        $vacancy_users = VacancyUser::with('supplier')
            ->where('vacancy_id', $vacancy->id)->where('status', 1)->get();
        if($request->status==2){
            $type = 'vacancy_change_status_paused';
            $status = \Lang::get('app.paused');
        } else if($request->status == 4){
            $status = \Lang::get('app.closed');
            $type = 'vacancy_change_status_closed';
        }
        foreach($vacancy_users as $v){
            event(new NotificationEvent(['element_id' => $vacancy->id,
                'user_id'=>$v->supplier->id, 'type' => $type, 'name'=>$vacancy->name]));
            $mailer->sendEmailSupplier($v->supplier, $vacancy, array_merge($request->all(), ['status' => $status]));
        }
        $mailer->sendEmailGtalents($vacancy, array_merge($request->all(), ['status' => $status]));
        return redirect()->back()
            ->withSuccess(trans('app.status_changed'));
    }

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
                                  FunctionalAreaRepository $functionalArea, IndustryRepository $industries,
                                  $url = null)
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
        $perPage = 10;
        $data = $this->vacancies->search(Auth::user()->company_user->company_id, $perPage, array_merge($request->all(), ['type' => ($url!= null) ? $url : 'find']));
        $vacanciesCount = $data['count'];
        $vacancies = $data['data'];
        $data = $request->all();
        $countries = $this->countries->lists()->toArray();
        //$vacancies = $this->vacancies->getOpportunities('poster_user_id',$this->theUser->id, $perPage);
        $vacancies_users_pages = ceil($vacanciesCount / $perPage);
        $vacancies_users_count = $perPage;
        if($url==null || $url=='find'){
            $vacancies = $this->vacanciesManager->orderVacancies($vacancies, $vacancies_users_count);
            return view('dashboard_user.post.index', compact('vacancies_users_count', 'vacancies_users_pages', 'countries', 'data', 'industries','vacanciesCount','vacancies', 'viewed'));
        } else if($url == 'poster'){
            return view('dashboard_user.post.index_poster', compact('vacancies_users_count', 'vacancies_users_pages', 'countries', 'data', 'industries','vacanciesCount','vacancies', 'viewed'));
        } else if($url == 'supplier'){
            return view('dashboard_user.post.index_supplier', compact('vacancies_users_count', 'vacancies_users_pages', 'countries', 'data', 'industries','vacanciesCount','vacancies', 'viewed'));
        }
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
        foreach(Auth::user()->vacancy as $vaccc){
            $userVacancy[] = $vaccc['id'];
            if($vaccc['id']==$id && $vaccc['pivot']['status']=='1'){
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
            $data = $this->getCandidatesSupplier(Auth::user()->id, $vacancy);
            $userCandidatesAvailable = $data['userCandidatesAvailable'];
            $userCandidatesProgress = $data['userCandidatesProgress'];
            $userCandidatesRejected = $data['userCandidatesRejected'];
            try{
                $credits_candidates = Setting::where('key', 'candidate_price')->get()->first()->value;
            } catch(\Exception $e){
                $credits_candidates = 100;
            }
            if(!$userSupplierPost){
                return view('dashboard_user.post.post_user',compact('userCandidatesRejected', 'userCandidatesProgress','credits_candidates', 'userCandidatesAvailable', 'userVacancy', 'vacancy','companies')) ;
            } else {
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
                $data1[$i]['actual_position'] = ActualPositionCandidate::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $i++;
            }
            if(VacancyCandidate::where('candidate_id', $can->id)->where('vacancy_id', $vacancy->id)
                ->where('status','!=','Rejected')->where('status','!=','Deleted')->get()->first()) {
                $data2[] = $can;
                $data2[$j]['actual_position'] = ActualPositionCandidate::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $j++;
            }
            if(VacancyCandidate::where('candidate_id', $can->id)->where('vacancy_id', $vacancy->id)->where('status','Rejected')->get()->first()) {
                $data3[] = $can;
                $data3[$p]['actual_position'] = ActualPositionCandidate::where('value_id', $can->actual_position_id)
                    ->where('language_id', $language)->get()->first()->name;
                $p++;
            }
        }
        return ['userCandidatesAvailable' =>  $data1, 'userCandidatesProgress' => $data2,
        'userCandidatesRejected' => $data3];
    }

    //** Request Supplier 
    public function post_supplier($id, InterestedMailer $mailer){
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
        $mailer->sendEmail($vacancy->poster, ['vacancy' => $vacancy, 'supplier' => Auth::user()]);
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
        $positions = VacancyCandidate::where('vacancy_id', $id)->where('status', 'Contract')->count();
        if($positions==$vacancy->positions_number){
            return redirect()->route('vacancies.show', $vacancy->id)
                ->withErrors(trans('app.number_positions_completed'));
        }
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

            $data =['vacancy_id'       => $vacancy->id,
                'number'           => substr (microtime(), 12, 20),
                'name'             => $request->position,
                'date_of_admission' => $data_admission[2].'-'.$data_admission[1].'-'.$data_admission[0],
                'offer'             => $request->details,
                'candidate_id'      => $candidate->id,
                'amount' => $request->salario,
                //'tax'              => ($vacancy->condition->comission)/$vacancy->positions_number,
                'supplier_user_id' => $candidate->supplier_user_id,
                'poster_user_id'   => NULL,
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
        $vacancy->updateStatusCandidate($candidate->id, 'Contract');

        $this->vacancy_candidates_status->create(['candidate_id' =>$candidate->id,
            'vacancy_id'=>$vacancy->id, 'status'=>'Contract']);
        $positions++;
        if($positions==$vacancy->positions_number) {
            $vacancy->vacancy_status_id = 4;
            $vacancy->save();
        }
        $rating = ['1' => -10, '2' => 0, '3' => 5, '4' => 10, '5' => 20];
        event(new RankingEvent(['user_id' => $candidate->supplier_user_id, 'points' => $rating[$request->rating.'']]));
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
