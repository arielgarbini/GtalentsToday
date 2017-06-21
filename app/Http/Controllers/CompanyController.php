<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use JavaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\Company;
use Vanguard\Events\RankingEvent;
use Vanguard\Http\Requests;
use Vanguard\Http\Requests\Company\CreateCompanyRequest;
use Vanguard\Http\Requests\Company\UpdateCompanyRequest;
use Vanguard\Http\Requests\Company\UpdateCompanyProfileRequest;
use Vanguard\Http\Requests\Company\UpdateCompanyExperienceRequest;
use Vanguard\Events\Company\UpdatedCompanyProfile;
use Vanguard\Events\Company\UpdatedCompanyExperience;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\Address\AddressRepository;
use Vanguard\Repositories\AddressType\AddressTypeRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Experience\ExperienceRepository;
use Vanguard\Repositories\Profile\ProfileRepository;
use Vanguard\Repositories\ProfilePosition\ProfilePositionRepository;
use Vanguard\Repositories\ActualPosition\ActualPositionRepository;
use Vanguard\Repositories\Sector\SectorRepository;
use Vanguard\Repositories\Region\RegionRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\ExperienceRole\ExperienceRoleRepository;
use Vanguard\Repositories\SourcingNetwork\SourcingNetworkRepository;
use Vanguard\Repositories\TypeSharedSearch\TypeSharedSearchRepository;
use Vanguard\Repositories\TypeInvolvedSearch\TypeInvolvedSearchRepository;
use Vanguard\Repositories\TypeSharedOpportunity\TypeSharedOpportunityRepository;
use Vanguard\Repositories\TypeInvolvedOpportunity\TypeInvolvedOpportunityRepository;
use Vanguard\Repositories\CasesNumber\CasesNumberRepository;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\LevelPosition\LevelPositionRepository;

class CompanyController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var CompanyRepository
     */
    private $companies;
    /**
     * @var CountryRepository
     */
    private $countries;
    /**
     * @var AddressRepository
     */
    private $address;
    /**
     * @var ProfileRepository
     */
    private $profiles;
    /**
     * @var ExperienceRepository
     */
    private $experiences;

    public function __construct(CompanyRepository $companies, 
                                CountryRepository $countries,
                                AddressRepository $address,
                                ProfileRepository $profiles,
                                ExperienceRepository $experiences)
    {     
        $this->middleware('permission:companies.manage');
        $this->companies = $companies;
        $this->countries = $countries;
        $this->address = $address;
        $this->profiles = $profiles;
        $this->experiences = $experiences;
        $this->theUser = Auth::user();

        JavaScript::put([
            'nonSelectedText_' => trans('app.non_selected_text'),
            'nSelectedText_'   => trans('app.n_selected_text'),
            'allSelectedText_' => trans('app.all_Selected_text')
        ]);
    }

    /**
     * Display page with all available companies.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        $perPage = 20;
       	$companies = $this->companies->paginate($perPage, Input::get('search'), Input::get('status'));

    	return view('company.index', compact('companies'));		
    }

    /**
     * Display form for creating new company.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create (AddressTypeRepository $addressTypes) 
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        if (session('lang') =='en')
            $language = 2;
        else
           $language = 1;

        $edit = false;
        $profile = false;
        $addressTypes = $addressTypes->lists($language);
        $countries = $this->countries->lists()->toArray();
        
        return view('company.add_edit', compact('edit', 'countries', 'addressTypes', 'profile'));	
    }

    /**
     * Store newly created company to database.
     *
     * @param CreateCompanyRequest $request
     * @return mixed
     */
    public function store (CreateCompanyRequest $request) 
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        $dataAddress = ['address_type_id' => $request->address_type_id,
                        'address'         => $request->address,
                        'state_id'        => $request->state,
                        'zip_code'        => $request->zip_code,
                        'city'            => $request->city,
                        'is_active'       => 1,
                        ];

        $address = $this->address->create($dataAddress);

        $request->merge(array('address_id' => $address->id));

        $data =  $request->except('state', 'zip_code', 'city', 'address', 'address_type_id') ;

        $company = $this->companies->create($data);

        $experience = $this->experiences->create(['company_id' => $company->id]);
        $profile = $this->profiles->create(['company_id' => $company->id]);
        
        return redirect()->route('companies.index')->withSuccess(trans('app.company_created'));
    }

    /**
     * Display specified category.
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Company $company)
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        return view('company.view', compact('company'));
    }

    /**
     * Display for editing specified category.
     *
     * @param Company $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit (AddressTypeRepository $addressTypes, $id)
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        if (session('lang') =='en')
            $language = 2;
        else
           $language = 1;

        $edit = true;
        $profile = false;
        $addressTypes = $addressTypes->lists($language);
        $countries = $this->countries->lists()->toArray();
        $company = $this->companies->find($id);

        return view('company.add_edit', compact('edit', 'company', 'addressTypes', 'countries', 'profile')); 
    }

    /**
     * Update user details.
     *
     * @param Company $id
     * @param UpdateCompanyRequest $request
     * @return mixed
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $data = $request->all();

        if(Auth::user()->hasRole('AdminConsultant'))
            $data =  $request->except('is_active');
        
        $this->companies->update($id, $data);
        
        return redirect()->back()->withSuccess(trans('app.company_updated_successfully'));
    }

    /**
     * Remove specified company from system.
     *
     * @param Company $company
     * @return mixed
     */
    public function delete(Company $company)
    {
        if(Auth::user()->hasRole('AdminConsultant'))
            return redirect()->route('company');

        $this->companies->delete($company->id);

        return redirect()->route('companies.index')->withSuccess(trans('app.company_deleted'));
    }

    /**
     * Display for editing your company.
     *
     * @param Company $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yourCompany (AddressTypeRepository $addressTypes,
                                ProfilePositionRepository $profilePositions, 
                                ActualPositionRepository $actualPositions, 
                                TypeSharedSearchRepository $typeSharedSearchs, 
                                TypeInvolvedSearchRepository $typeInvolvedSearchs, 
                                TypeSharedOpportunityRepository $typeSharedOpportunities, 
                                TypeInvolvedOpportunityRepository $typeInvolvedOpportunities, 
                                CasesNumberRepository $casesNumbers, 
                                ExperienceYearRepository $experienceYears, 
                                LevelPositionRepository $levelPositions, 
                                SectorRepository $sectors, 
                                IndustryRepository $industries, 
                                RegionRepository $regions, 
                                ExperienceRoleRepository $experienceRoles, 
                                FunctionalAreaRepository $functionalAreas, 
                                SourcingNetworkRepository $sourcingNetworks)
    {
        if (session('lang') =='en')
            $language = 2;
        else
           $language = 1;

        $edit = true;
        $profile = true;
        $addressTypes = $addressTypes->lists($language);
        $countries = $this->countries->lists()->toArray();
        $company = $this->companies->find($this->theUser->company_user->company_id);

        $profilePositions = $profilePositions->lists($language); 
        $actualPositions = $actualPositions->lists($language);
        $typeSharedSearchs = $typeSharedSearchs->lists($language);
        $typeInvolvedSearchs = $typeInvolvedSearchs->lists($language);
        $typeSharedOpportunities = $typeSharedOpportunities->lists($language);
        $typeInvolvedOpportunities = $typeInvolvedOpportunities->lists($language);
        $casesNumbers = $casesNumbers->lists($language);
        $experienceYears = $experienceYears->lists($language);
        $levelPositions = $levelPositions->lists($language);

        $sector_selected = $this->listSelected($company->experience->sectors);
        $region_selected = $this->listSelected($company->experience->regions);
        $industry_selected = $this->listSelected($company->experience->industries);
        $experience_role_selected = $this->listSelected($company->experience->experience_roles);
        $functional_area_selected = $this->listSelected($company->experience->functional_areas);
        $sourcing_network_selected = $this->listSelected($company->experience->sourcing_networks);

        $sectors = $sectors->lists($language);
        $regions = $regions->lists($language);
        $industries = $industries->lists($language);
        $experienceRoles = $experienceRoles->lists($language);
        $functionalAreas = $functionalAreas->lists($language);
        $sourcingNetworks = $sourcingNetworks->lists($language);

        return view('company.add_edit', compact( 'edit', 'company', 'addressTypes', 'countries', 'profile', 
                        'profilePositions', 'actualPositions', 'typeSharedSearchs', 'typeInvolvedSearchs',
                        'typeSharedOpportunities', 'typeInvolvedOpportunities', 'casesNumbers', 
                        'experienceYears', 'levelPositions', 'sectors', 'sector_selected', 'regions',
                        'region_selected', 'industries', 'industry_selected', 'experienceRoles', 
                        'experience_role_selected', 'functionalAreas', 'functional_area_selected', 
                        'sourcingNetworks', 'sourcing_network_selected'));
    }

    /**
     * listSelected.
     *
     * @param Array $array
     * @return mixed
     */
    public function listSelected($array){
        $result [] = '';
        foreach ($array as $object) {
            $result [] = $object->id;
        }
        return $result;
    }
    
    

    /**
     * Update company profile.
     *
     * @param UpdateCompanyProfileRequest $request
     * @return mixed
     */
    public function updateProfile(UpdateCompanyProfileRequest $request)
    {
        $company = $this->companies->find($this->theUser->company_user->company_id);

        $this->profiles->update($company->profile->id, $request->except('points'));

        event(new UpdatedCompanyProfile($company));

        return redirect()->route('company')
            ->withSuccess(trans('app.user_profile_updated_successfully'));
    }

    /**
     * Update company experience.
     *
     * @param UpdateCompanyExperienceRequest $request
     * @return mixed
     */
    public function updateExperience(UpdateCompanyExperienceRequest $request)
    {
        $company = $this->companies->find($this->theUser->company_user->company_id);

        $id_exp = $company->experience->id;

        $this->experiences->update($id_exp, $request->all());

        //Sector Sync
        $sector_selected = $request->input('list_sectors');
        if(isset($sector_selected) And count($sector_selected) > 0 )
            $this->experiences->sectors($id_exp)->sync($sector_selected);
        else
            $this->experiences->sectors($id_exp)->detach();

        //Industry Sync
        $industry_selected = $request->input('list_industries');
        if(isset($industry_selected) And count($industry_selected) > 0 )
            $this->experiences->industries($id_exp)->sync($industry_selected);
        else
            $this->experiences->industries($id_exp)->detach();

        //Region Sync
        $region_selected = $request->input('list_regions');
        if(isset($region_selected) And count($region_selected) > 0 )
            $this->experiences->regions($id_exp)->sync($region_selected);
        else
            $this->experiences->regions($id_exp)->detach();

        //ExperienceRole Sync
        $experience_role_selected = $request->input('list_experience_roles');
        if(isset($experience_role_selected) And count($experience_role_selected) > 0 )
            $this->experiences->experience_roles($id_exp)->sync($experience_role_selected);
        else
            $this->experiences->experience_roles($id_exp)->detach();

        //FunctionalAreas Sync
        $functional_area_selected = $request->input('list_functional_areas');
        if(isset($functional_area_selected) And count($functional_area_selected) > 0 )
            $this->experiences->functional_areas($id_exp)->sync($functional_area_selected);
        else
            $this->experiences->functional_areas($id_exp)->detach();

        //SourcingNetworks Sync
        $sourcing_network_selected = $request->input('list_sourcing_networks');
        if(isset($sourcing_network_selected) And count($sourcing_network_selected) > 0 )
            $this->experiences->sourcing_networks($id_exp)->sync($sourcing_network_selected);
        else
            $this->experiences->sourcing_networks($id_exp)->detach();

        event(new UpdatedCompanyExperience($company));

        return redirect()->back()
            ->withSuccess(trans('app.user_experience_updated_successfully'));
    }

    public function updatePoints(Request $request, $company_id)
    {
        event(new RankingEvent(['company_id' => $company_id, 'points' => $request->points]));
        return redirect()->route('companies.index')->withSuccess(trans('app.points_success'));
    }
}
