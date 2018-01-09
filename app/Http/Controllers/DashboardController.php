<?php

namespace Vanguard\Http\Controllers;

use Vanguard\Candidate;
use Vanguard\ActualPositionCandidate;
use Illuminate\Http\Request;
use Vanguard\Notification;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Vanguard\Repositories\VacancyUser\VacancyUserRepository;
use Vanguard\Repositories\VacancyViewedRepository;
use Vanguard\Services\Vacancies\VacancyManager;
use Vanguard\Support\Enum\UserStatus;
use Auth;
use Carbon\Carbon;
use Vanguard\CompanyUser;
use Vanguard\VacancyCandidate;
use Vanguard\VacancyViewed;
use Vanguard\Vacancy;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var ActivityRepository
     */
    private $activities;
    /**
     * @var VacancyRepository
     */
    private $vacancies;

    /**
     * DashboardController constructor.
     * @param UserRepository $users
     * @param ActivityRepository $activities
     */

    private $viewed;

    private $vacanciesManager;

    public function __construct(UserRepository $users,
                                ActivityRepository $activities,
                                VacancyRepository $vacancies,
                                VacancyUserRepository $vacancies_users,
                                VacancyManager $vacanciesManager)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
        $this->vacancies = $vacancies;
        $this->vacancies_users = $vacancies_users;
        $this->vacanciesManager = $vacanciesManager;
    }

    /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            return $this->adminDashboard();
        }

        return $this->defaultDashboard();
    }

    /**
     * Displays dashboard for admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function adminDashboard()
    {
        $usersPerMonth = $this->users->countOfNewUsersPerMonth(
            Carbon::now()->startOfYear(),
            Carbon::now()
        );

        $stats = [
            'total' => $this->users->count(),
            'new' => $this->users->newUsersCount(),
            'banned' => $this->users->countByStatus(UserStatus::BANNED),
            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ];

        $latestRegistrations = $this->users->latest(7);

        return view('dashboard.admin', compact('stats', 'latestRegistrations', 'usersPerMonth'));
    }

    /**
     * Displays default dashboard for non-admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    //$latestVacancies        = $this->vacancies->lastestPoster('poster_user_id',Auth::user()->id,$perPage);
    //$vacancies_users        = $this->vacancies_users->where('status',0); //** Request Supplier
    //$vacancies_users = $this->vacancies->getSupplier('vacancy_users','vacancy_users.vacancy_id','vacancies.id','users','users.id','vacancy_users.supplier_user_id','vacancies.poster_user_id', 'users.*', 'vacancy_users.status', 0, 'vacancies.*','vacancy_users.*', Auth::user()->id);

    private function defaultDashboard()
    {
        $user_id = Auth::user()->id;
        //Notification::where('user_id', \Auth::user()->id)->where('read',0)->update(['read' => 1]);
        $activities = $this->activities->userActivityForPeriod(
            Auth::user()->id,
            Carbon::now()->subWeeks(2),
            Carbon::now()
        )->toArray();

        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }
        $paginate = 5;
        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
        $team = CompanyUser::where(['company_id' => $company_id])->where('user_id', '!=', Auth::user()->id)->orderBy('created_at','desc')->get();
        $candidates = Candidate::where('supplier_user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        $data1 = [];
        $i = 0;
        foreach ($candidates as $can){
            $data1[] = $can;
            $data1[$i]['actual_position'] = ActualPositionCandidate::where('value_id', $can->actual_position_id)
                ->where('language_id', $language)->get()->first()->name;
            $i++;
        }
        $candidates = $data1;
        $latestVacanciesCount = $paginate;
        $vacancies_users_count = $paginate;
        $latestVacancies = Vacancy::where('poster_user_id', '=', Auth::user()->id)
            ->where(function($q){
                $q->where('vacancy_status_id', 1);
                $q->orWhere('vacancy_status_id', 5);
            })->orderBy('created_at', 'DESC');
        $latestVacanciesClone = clone $latestVacancies;
        $latestVacanciesPages = ceil($latestVacanciesClone->count() / $latestVacanciesCount);
        $latestVacancies = $latestVacancies->limit($latestVacanciesCount)->get();
        $vacancies_users = Vacancy::whereHas('asSupplier', function($query) use($user_id){
            $query->where('supplier_user_id', $user_id)->where('status',1);
        })->where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->orderBy('created_at', 'DESC');
        $vacancies_users_clone = clone $vacancies_users;
        $vacancies_users_pages = ceil($vacancies_users_clone->count() / $vacancies_users_count);
        $vacancies_users = $vacancies_users->limit($vacancies_users_count)->get();
        $lastestOpportunities = $this->vacanciesManager->getRecommended(3);
        //dd($lastestOpportunities);
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $potentialPoster = 0;
        $potentialSupplier = 0;
        $latestVacanciesPoster = Vacancy::where('company_id', '=', Auth::user()->company_user->company_id)->where('general_conditions', '!=', '')
            ->orderBy('created_at', 'DESC')
            ->where(function($q){
                $q->where('vacancy_status_id', 1);
                $q->orWhere('vacancy_status_id', 5);
            })->get();
        $vacanciesPoster = [];
        foreach($latestVacanciesPoster as $vacancy){
            $vacanciesPoster[] = $vacancy->id;
            if($vacancy->group1==1) {
                preg_match_all('/\d{1,3}/' ,$vacancy->range_salary, $matches);
                $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                $factur = ($vacancy->fee * $factur) / 100;
                $potentialPoster += $factur;
            } else {
                $potentialPoster += intval($vacancy->fee);
            }
        }
        $users_company = [];
        foreach(Auth::user()->company_user->company->users as $u) {
            $users_company[] = $u->id;
        }
        $candidatePoster = VacancyCandidate::whereIn('vacancy_id', $vacanciesPoster)
            ->where('status','Contract')->count();
        $latestVacanciesSupplier = Vacancy::whereHas('asSupplier', function($query) use($users_company){
            $query->whereIn('supplier_user_id', $users_company)->where('status',1);
        })->where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->get();
        $vacanciesSupplier = [];
        foreach($latestVacanciesSupplier as $vacancy){
            $vacanciesSupplier[] = $vacancy->id;
            if($vacancy->group1==1) {
                preg_match_all('/\d{1,3}/' ,$vacancy->range_salary, $matches);
                $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                $factur = ($vacancy->fee * $factur) / 100;
                $potentialSupplier += $factur;
            } else {
                $potentialSupplier += intval($vacancy->fee);
            }
        }
        $candidateSupplier = VacancyCandidate::whereIn('vacancy_id', $vacanciesSupplier)
            ->where('status','Contract')->count();
        return view('dashboard_user.default', compact('candidatePoster', 'candidateSupplier', 'vacancies_users_pages', 'vacancies_users_count', 'latestVacanciesPages', 'latestVacanciesCount', 'latestVacanciesSupplier','latestVacanciesPoster','potentialSupplier','potentialPoster','viewed','team', 'candidates', 'activities', 'latestVacancies', 'vacancies_users','lastestOpportunities' ));
    }

    public function getVacanciesPoster(Request $request)
    {
        $latestVacancies = Vacancy::where('poster_user_id', '=', Auth::user()->id)
            ->where(function($q){
                $q->where('vacancy_status_id', 1);
                $q->orWhere('vacancy_status_id', 5);
            })->orderBy('created_at', 'DESC');

        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $count = clone $latestVacancies;
        $data = view('partials.vacancies.poster',
            ['latestVacancies' => $latestVacancies->limit($request->count)->offset(($request->page-1)*$request->count)->get(),
            'viewed' => $viewed]);
        $data = $data->render();
        return response()->json(['count'=>$count->count(), 'page'=>ceil($count->count()/$request->count), 'data' => $data]);
    }

    public function getVacanciesUser(Request $request)
    {
        $user_id = Auth::user()->id;
        $vacancies_users = Vacancy::whereHas('asSupplier', function($query) use($user_id){
            $query->where('supplier_user_id', $user_id)->where('status',1);
        })->where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->orderBy('created_at', 'DESC');

        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $count = clone $vacancies_users;
        $data = view('partials.vacancies.user',
            ['vacancies_users' => $vacancies_users->limit($request->count)->offset(($request->page-1)*$request->count)->get(),
                'viewed' => $viewed]);
        $data = $data->render();
        return response()->json(['count'=>$count->count(), 'page'=>ceil($count->count()/$request->count), 'data' => $data]);
    }

    public function getVacanciesFind(Request $request, $url = null)
    {
        $perPage = 10;
        $data = $this->vacancies->search(\Auth::user()->company_user->company_id, $perPage, array_merge($request->all(), ['type' => ($url!= null) ? $url : 'find']));
        $vacanciesCount = $data['count'];
        $vacancies = $data['data'];
        $data = $request->all();
        $vacancies_users_pages = ceil($vacanciesCount / $perPage);
        $vacancies_users_count = $perPage;
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        if($url==null || $url=='find'){
            $vacancies = $this->vacanciesManager->orderVacancies($vacancies, $vacancies_users_count, $request->all());
            $data = view('partials.vacancies.user', ['vacancies_users' => $vacancies, 'viewed' => $viewed]);
        } else if($url == 'poster'){
            $data = view('partials.vacancies.poster', ['latestVacancies' => $vacancies, 'viewed' => $viewed]);
        } else if($url == 'supplier'){
            $data = view('partials.vacancies.user', ['vacancies_users' => $vacancies, 'viewed' => $viewed]);
        }
        $data = $data->render();
        return response()->json(['count'=>count($vacancies), 'page'=>$vacancies_users_pages, 'data' => $data]);
    }
}
