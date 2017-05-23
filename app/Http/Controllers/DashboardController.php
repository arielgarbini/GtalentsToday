<?php

namespace Vanguard\Http\Controllers;

use Vanguard\Candidate;
use Vanguard\ActualPosition;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Vanguard\Repositories\VacancyUser\VacancyUserRepository;
use Vanguard\Repositories\VacancyViewedRepository;
use Vanguard\Support\Enum\UserStatus;
use Auth;
use Carbon\Carbon;
use Vanguard\CompanyUser;
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

    public function __construct(UserRepository $users,
                                ActivityRepository $activities,
                                VacancyRepository $vacancies,
                                VacancyUserRepository $vacancies_users)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
        $this->vacancies = $vacancies;
        $this->vacancies_users = $vacancies_users;
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
            $data1[$i]['actual_position'] = ActualPosition::where('value_id', $can->actual_position_id)
                ->where('language_id', $language)->get()->first()->name;
            $i++;
        }
        $candidates = $data1;
        $latestVacancies = Vacancy::where('poster_user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate($paginate);
        $vacancies_users = Vacancy::whereHas('asSupplier', function($query) use($user_id){
            $query->where('supplier_user_id', $user_id)->where('status',1);
        })->where('vacancy_status_id', 1)->paginate($paginate);
        $lastestOpportunities = Vacancy::where('vacancy_status_id', 1)->orderBy('created_at', 'desc')
            ->where('poster_user_id', '!=', Auth::user()->id)->whereNotExists(function ($query) use($user_id){
                $query->select('vacancy_users.*')->from('vacancy_users')
                    ->where('supplier_user_id',$user_id)->whereRaw('vg_vacancy_users.vacancy_id = vg_vacancies.id');
            })->limit(3)->get(); //** Opportunities Available
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $potentialPoster = 0;
        $potentialSupplier = 0;
        $latestVacanciesPoster = Vacancy::where('poster_user_id', '=', Auth::user()->id)->where('general_conditions', '!=', '')
            ->orderBy('created_at', 'DESC')->get();
        foreach($latestVacanciesPoster as $vacancy){
            preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
            $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
            $potentialPoster += $factur;
        }
        $latestVacanciesSupplier = Vacancy::whereHas('asSupplier', function($query) use($user_id){
            $query->where('supplier_user_id', $user_id)->where('status',1);
        })->get();
        foreach($latestVacanciesSupplier as $vacancy){
            preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
            $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
            $potentialSupplier += $factur;
        }
        return view('dashboard_user.default', compact('latestVacanciesSupplier','latestVacanciesPoster','potentialSupplier','potentialPoster','viewed','team', 'candidates', 'activities', 'latestVacancies', 'vacancies_users','lastestOpportunities' ));
    }


}