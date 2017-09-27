<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\QuantityEmployees;
use Vanguard\Repositories\Category\CategoryRepository;
use Vanguard\Repositories\ContractType\ContractTypeRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Experience\ExperienceRepository;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
use Vanguard\Repositories\Language\LanguageRepository;
use Vanguard\Repositories\QuantityEmployees\QuantityEmployeesRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\VacancyCandidate;
use Vanguard\Candidate;
use Vanguard\Invoice;
use Vanguard\Testimonial;
use Vanguard\Events\NotificationEvent;
use Vanguard\Notification;
use Vanguard\Events\RankingEvent;
use Vanguard\Services\Suppliers\SupplierManager;

class SupplierController extends Controller
{

    private $supplierManager;

    private $users;

    public function __construct(SupplierManager $supplierManager, UserRepository $users)
    {
        $this->supplierManager = $supplierManager;
        $this->users = $users;
    }

    public function index(Request $request, FunctionalAreaRepository $functionalArea,
                          IndustryRepository $industries, CountryRepository $countries,
                          QuantityEmployeesRepository $quantityEmployees, CategoryRepository $categories)
    {
        if(!isset($request->vacancy)){
            return redirect()->route('dashboard');
        }
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }
        $categories = $categories->lists($language);
        $functionalArea = $functionalArea->lists($language);
        $quantityEmployees = $quantityEmployees->lists($language);
        $industries = $industries->lists($language);
        $qualification = ['1' => '1 '.\Lang::get('app.star'),
            '2' => '2 '.\Lang::get('app.star').'s',
            '3' => '3 '.\Lang::get('app.star').'s',
            '4' => '4 '.\Lang::get('app.star').'s',
            '5' => '5 '.\Lang::get('app.star').'s'];
        $perPage = 10;
        $data = $this->users->search($request->vacancy, \Auth::user()->company_user->company_id, $perPage, $request->all());
        $suppliersCount = $data['count'];
        $suppliers = $data['data'];
        $data = $request->all();
        $countries = $countries->lists()->toArray();
        $suppliers_users_pages = ceil($suppliersCount / $perPage);
        $suppliers_users_count = $perPage;
        $suppliers = $this->supplierManager->orderSuppliers($suppliers, $perPage, $request->all(), $request->vacancy);
        return view('dashboard_user.supplier.index', compact('qualification', 'categories', 'quantityEmployees', 'functionalArea', 'suppliers_users_count', 'suppliers_users_pages', 'countries', 'data', 'industries','suppliersCount','suppliers'));
    }

    public function getSuppliersFind(Request $request)
    {
        $perPage = 10;
        $data = $this->users->search($request->vacancy, \Auth::user()->company_user->company_id, $perPage, $request->all());
        $suppliersCount = $data['count'];
        $suppliers = $data['data'];
        $data = $request->all();
        $suppliers_users_pages = ceil($suppliersCount / $perPage);
        $suppliers_users_count = $perPage;
        $suppliers = $this->supplierManager->orderSuppliers($suppliers, $perPage, $request->all(), $request->vacancy);
        $data = view('partials.vacancies.user', ['vacancies_users' => $vacancies, 'viewed' => $viewed]);
        $data = $data->render();
        return response()->json(['count'=>count($vacancies), 'page'=>$vacancies_users_pages, 'data' => $data]);
    }

    public function calificationSupplier(Request $request, $id)
    {
        $vacancy_user = VacancyCandidate::find($id);
        $candidate = Candidate::where('id', $vacancy_user->candidate_id)->get()->first();
        $invoices = Invoice::where('vacancy_id', $vacancy_user->vacancy_id)
            ->where('supplier_user_id', $candidate->supplier_user_id)->where('candidate_id', $candidate->id)->get()->first();
        if(isset($invoices->date_of_admission) && $invoices->date_of_admission!=''){
            $date_of_admission = explode('-', $invoices->date_of_admission);
            $date_of_admission = $date_of_admission[2].'/'.$date_of_admission[1].'/'.$date_of_admission[0];
        } else {
            $date_of_admission = '';
        }
        return view('dashboard_user.supplier.calification_supplier', compact('candidate', 'id', 'invoices', 'date_of_admission'));
    }

    public function calificationSupplierStore(Request $request, $id)
    {
        $vacancy_user = VacancyCandidate::find($id);
        $candidate = Candidate::where('id', $vacancy_user->candidate_id)->get()->first();

        $data = [
            'recommended_user_id' => $vacancy_user->vacacy->poster_user_id,
            'recommended_by_user_id' => \Auth::user()->id,
            'testimony'             => $request->comments_poster,
            'type'                  => 'poster',
            'vacancy_id'            => $vacancy_user->vacancy_id,
            'point'                 => $request->rating,
            'is_active'             => 1
        ];

        Testimonial::create($data);
        $vacancy_user = VacancyCandidate::where('vacancy_id', $vacancy_user->vacancy_id)
            ->where('candidate_id', $candidate->id)->get()->first();

        event(new NotificationEvent(['element_id' => $vacancy_user->id,
            'user_id'=>$vacancy_user->vacacy->poster_user_id, 'type' => 'qualify_supplier_vacancy', 'name'=>$vacancy_user->vacacy->name]));
        $rating = ['1' => -10, '2' => 0, '3' => 5, '4' => 10, '5' => 20];
        event(new RankingEvent(['user_id' => $vacancy_user->vacacy->poster_user_id, 'points' => $rating[$request->rating.'']]));
        return redirect()->route('dashboard')
            ->withSuccess(trans('app.rating_submitted'));
    }
}
