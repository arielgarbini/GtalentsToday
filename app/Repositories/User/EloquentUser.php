<?php

namespace Vanguard\Repositories\User;

use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Role;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\CompanyUser;
use Vanguard\User;
use Carbon\Carbon;
use Auth;
use DB;
use Illuminate\Database\SQLiteConnection;
use Laravel\Socialite\Contracts\User as SocialUser;

class EloquentUser implements UserRepository
{
    /**
     * @var UserAvatarManager
     */
    private $avatarManager;
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(UserAvatarManager $avatarManager, RoleRepository $roles)
    {
        $this->avatarManager = $avatarManager;
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return User::find($id);
    }

    public function search($id, $user, $perPage, array $data)
    {
        $user_id = \Auth::user()->id;
        /*$company = Company::find($user);
        $users_company = [];
        foreach($company->users as $u){
            $users_company[] = $u->id;
        }*/

        $supplier = User::where('users.id','!=',Auth::user()->id)->whereNotExists(function($query) use($id){
            $query->select('vacancy_users.*')->from('vacancy_users')
                ->where('vacancy_id', $id)->whereRaw('vg_vacancy_users.supplier_user_id = vg_users.id');
        })->whereHas('company_user', function($q) use($user){
            $q->where('companies_users.company_id', '!=', $user);
        })->with('company.category')->with('company_user')
            ->join('companies_users', 'users.id', '=', 'companies_users.user_id')
            ->join('companies', 'companies_users.company_id', '=', 'companies.id');
        dd($supplier->get()[0]);
        if(isset($data['search']) && $data['search']!=''){
            $supplier->where('users.code', 'like', '%'.$data['search'].'%');
            //$supplier->where(function ($query) use($data){
                /*$query->orWhere('users.code', 'like', '%'.$data['search'].'%');
                $query->orWhere('target_companies', 'like', '%'.$data['search'].'%');
                $query->orWhere('off_limits_companies', 'like', '%'.$data['search'].'%');
                $query->orWhere('responsabilities', 'like', '%'.$data['search'].'%');
                $query->orWhere('required_experience', 'like', '%'.$data['search'].'%');*/
            //});
        }

        if(isset($data['country_id']) && $data['country_id']!=''){
            $supplier->where('country_id', $data['country_id']);
        }

        /*if(isset($data['state_id']) && $data['state_id']!=''){
            $supplier->where('state_id', $data['state_id']);
        }

        if(isset($data['city_id']) && $data['city_id']!=''){
            $supplier->where('city_id', $data['city_id']);
        }*/

        if(isset($data['industry']) && $data['industry']!=''){
            $supplier->where('industry', $data['industry']);
        }

        if(isset($data['periods']) && $data['periods']!=''){
            $supplier->where('vacancies.created_at', '>=', Carbon::now()->subDays($data['periods'])->format('Y-m-d'));
        }

        if(isset($data['order'])){
            $supplier->orderBy($data['order'], 'desc');
        } else {
            $supplier->orderBy('users.created_at', 'desc');
        }
        /*
        if (isset($data['page']) && $data['page'] != '') {
            $supplier->offset(($data['page'] - 1) * $perPage);
        }
        $supplier->limit($perPage);*/

        return ['count'=> $supplier->count(), 'data' => $supplier->get()];
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySocialId($provider, $providerId)
    {
        return User::leftJoin('social_logins', 'users.id', '=', 'social_logins.user_id')
            ->select('users.*')
            ->where('social_logins.provider', $provider)
            ->where('social_logins.provider_id', $providerId)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function associateSocialAccountForUser($userId, $provider, SocialUser $user)
    {
        return DB::table('social_logins')->insert([
            'user_id' => $userId,
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = User::query();

        if(Auth::user()->hasRole('AdminConsultant')){
            $query->leftJoin('companies_users', 'users.id', '=', 'companies_users.user_id')
                ->select('users.*')
                ->where('companies_users.company_id', Auth::user()->company_user->company_id)
                ->get();
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('username', "like", "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('first_name', 'like', "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        return $this->find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateSocialNetworks($userId, array $data)
    {
        return $this->find($userId)->socialNetworks()->updateOrCreate([], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $user = $this->find($id);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        return $user->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return User::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newUsersCount()
    {
        return User::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }

    /**
     * {@inheritdoc}
     */
    public function countByStatus($status)
    {
        return User::where('status', $status)->count();
    }

    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return User::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewUsersPerMonth($from, $to)
    {
        $perMonthQuery = $this->getPerMonthQuery();

        $result = User::select([
            DB::raw("{$perMonthQuery} as month"),
            DB::raw('count(id) as count')
        ])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->lists('count', 'month');

        $counts = [];

        foreach(range(1, 12) as $m) {
            $month = date('F', mktime(0, 0, 0, $m, 1));

            $month = trans("app.months.{$month}");

            $counts[$month] = isset($result[$m])
                ? $result[$m]
                : 0;
        }

        return $counts;
    }

    /**
     * Creates query that will be used to fetch users per
     * month, depending on type of the connection.
     *
     * @return string
     */
    private function getPerMonthQuery()
    {
        $connection = DB::connection();

        if ($connection instanceof SQLiteConnection) {
            return 'CAST(strftime(\'%m\', created_at) AS INTEGER)';
        }

        return 'MONTH(created_at)';
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersWithRole($roleName)
    {
        return Role::where('name', $roleName)
            ->first()
            ->users;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserSocialLogins($userId)
    {
        $result = DB::table('social_logins')
            ->where('user_id', $userId)
            ->get();

        return collect($result);
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($userId, $roleId)
    {
        $roleId = is_array($roleId) ?: [$roleId];

        return $this->find($userId)->roles()->sync($roleId);
    }

    /**
     * {@inheritdoc}
     */
    public function findByConfirmationToken($token)
    {
        return User::where('confirmation_token', $token)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function switchRolesForUsers($fromRoleId, $toRoleId)
    {
        return DB::table('role_user')
            ->where('role_id', $fromRoleId)
            ->update(['role_id' => $toRoleId]);
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'first_name', $key = 'id')
    {
        return User::lists($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function countByCompany($id)
    {
        return DB::table('companies_users')->where('company_id', $id)->count();
    }

    /**
     * {@inheritdoc}
     */
    public function company($id){

        $user = $this->find($id);

        return $user->company();
    }

    /**
     * {@inheritdoc}
     */
    public function findByCompany($id)
    {
        return DB::table('users')->leftJoin('companies_users', 'users.id', '=', 'companies_users.user_id')
                    ->select('users.*')
                    ->where('companies_users.company_id', Auth::user()->company_user->company_id)
                    ->where('companies_users.user_id', $id)
                    ->count();
    }

}