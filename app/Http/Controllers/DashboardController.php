<?php

namespace Vanguard\Http\Controllers;

use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Vacancy\VacancyRepository;
use Vanguard\Repositories\VacancyUser\VacancyUserRepository;
use Vanguard\Support\Enum\UserStatus;
use Auth;
use Carbon\Carbon;

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
    private function defaultDashboard()
    {
        $activities = $this->activities->userActivityForPeriod(
            Auth::user()->id,
            Carbon::now()->subWeeks(2),
            Carbon::now()
        )->toArray();


        $perPage =20;
        $latestVacancies        = $this->vacancies->lastestPoster('poster_user_id',Auth::user()->id,$perPage);      
      //  $vacancies_users        = $this->vacancies_users->where('status',0); //** Request Supplier  
        $vacancies_users = $this->vacancies->getSupplier('vacancy_users','vacancy_users.vacancy_id','vacancies.id','users','users.id','vacancy_users.supplier_user_id','vacancies.poster_user_id', 'users.*', 'vacancy_users.status', 0, 'vacancies.*','vacancy_users.*', Auth::user()->id);
        $lastestOpportunities   = $this->vacancies->lastestOpportunities('poster_user_id',Auth::user()->id,$perPage); //** Opportunities Available

        return view('dashboard_user.default', compact('activities', 'latestVacancies', 'vacancies_users','lastestOpportunities' ));
    }


}