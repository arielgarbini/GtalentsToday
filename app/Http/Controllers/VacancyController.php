<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\ContractType;
use Vanguard\Events\Vacancy\Viewed;
use Vanguard\Events\Vacancy\Logged;
use Vanguard\Events\Vacancy\Applied;
use Vanguard\Events\NotificationEvent;
use Vanguard\ExperienceYear;
use Vanguard\FunctionalArea;
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
use Vanguard\Services\Upload\FileManager;
use Vanguard\Support\Enum\InvoiceStatus;
use Vanguard\Support\Enum\GeneralStatus;
use Vanguard\Http\Requests;
use Vanguard\User;
use Vanguard\Vacancy;
use Vanguard\VacancyUser;
use Vanguard\CompanyUser;
use JavaScript;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;


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
                                CompanyRepository $companies)
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
            return view('dashboard_user.post.post_detail', compact('vacancy'));
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

        //event(new NotificationEvent(['element_id' => $vacancy->id,
        //    'user_id'=>$vacancy_users->supplier_user_id, 'type' => 'approved_supplier_vacancy', 'name'=>$vacancy->name]));

        return redirect()->back()
            ->withSuccess(trans('app.reject_application'));
    }

    /**
     * Approbate candidate in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function approbateCandidate(Request $request)
    {
        $vacancy = $this->vacancies->find($request->vacancy);
        $return = $vacancy->updateStatusCandidate($request->candidate, GeneralStatus::ACTIVE);

        $candidate = $this->candidates->find($request->candidate);

        if($vacancy->isApprobateCandidate($candidate->id)){
            $data =['vacancy_id'       => $vacancy->id, 
                    'number'           => substr (microtime(), 12, 20), 
                    'name'             => 'Invoice test', 
                    'amount' => ($vacancy->condition->approximate_total_billing)/$vacancy->positions_number, 
                    'tax'              => ($vacancy->condition->comission)/$vacancy->positions_number, 
                    'supplier_user_id' => $candidate->supplier_user_id, 
                    'poster_user_id'   => $vacancy->poster_user_id, 
                    'status'           => InvoiceStatus::PENDING,  
                    'payment_due'      => $vacancy->created_at->addDays(12)
                    ];

            $this->invoices->create($data);

            //Vacancy Log
            event(new Logged($vacancy, $candidate));
        }

        return $return;
    }

    /**
     * Reject candidate in specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function rejectCandidate(Request $request)
    {
        $vacancy = $this->vacancies->find($request->vacancy);

        return $vacancy->updateStatusCandidate($request->candidate, GeneralStatus::REJECTED);
    }

    /**
     * To apply specified vacancy with provided data.
     *
     * @param int $id
     * @return mixed
     */
    public function postulateCandidate(Request $request)
    {
        $vacancy = $this->vacancies->find($request->vacancy);              

        $data = [ 'status'      => GeneralStatus::UNCONFIRMED,
                  'created_at'  => \Carbon\Carbon::now(),
                  'updated_at'  => \Carbon\Carbon::now() ];

        //Postulate
        return $this->vacancies->candidates($vacancy->id)->attach($request->candidate, $data);
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
    public function listVacancies()
    {
        $perPage = 20; 
        $vacancies = $this->vacancies->getOpportunities('poster_user_id',$this->theUser->id, $perPage);
     
        return view('dashboard_user.post.index', compact('vacancies'));     
    }

    //** Detail Opportunity Available
    public function show_post_user($id, User $users){
        $vacancy = $this->vacancies->find($id);
        $userVacancy = [];
        $userSupplierPost = false;
        foreach(Auth::user()->vacancy as $vacancy){
            $userVacancy[] = $vacancy['id'];
            if($vacancy['id']==$id && $vacancy['pivot']['status']=='1'){
                $userSupplierPost = true;
            }
        }
        event(new Viewed($vacancy));
        if (isset($vacancy)) {
            $companies_users = $this->companies_users->where('user_id',$this->theUser->id);
            if ($companies_users){
              $companies  = $this->companies->find($companies_users->company_id);                
            }
            if(!$userSupplierPost){
                return view('dashboard_user.post.post_user',compact('userVacancy', 'vacancy','companies')) ;
            } else {
                return view('dashboard_user.post.post_supplier',compact('userVacancy', 'vacancy','companies')) ;
            }

        }
       return redirect()->action('VacancyController@list')
          ->withErrors(trans('app.register_not_found'));
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
}
