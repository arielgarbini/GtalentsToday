<?php

namespace Vanguard\Repositories\Vacancy;

use Vanguard\Company;
use Vanguard\Events\Vacancy\Created;
use Vanguard\Events\Vacancy\Deleted;
use Vanguard\Events\Vacancy\Updated;
use Cache;
use Vanguard\Vacancy;
use DB;
use Carbon\Carbon;

class EloquentVacancy implements VacancyRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {        
        return Vacancy::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Vacancy::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Vacancy::query();

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }

        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    public function search($user, $perPage, array $data)
    {
        $user_id = \Auth::user()->id;
        $company = Company::find($user);
        $users_company = [];
        foreach($company->users as $u){
            $users_company[] = $u->id;
        }
        if(isset($data['type']) && $data['type']=='find'){
            $vacancy = Vacancy::select('vacancies.*')->where('company_id', '!=', $user)->where('vacancy_status_id', 1)->whereNotExists(function ($query) use($users_company){
                $query->select('vacancy_users.*')->from('vacancy_users')
                    ->whereIn('supplier_user_id',$users_company)->whereRaw('vg_vacancy_users.vacancy_id = vg_vacancies.id');
            })->join('companies', function($join)
            {
                $join->on('vacancies.company_id', '=', 'companies.id');
            })->orderBy('category_id', 'DESC');
        } else if(isset($data['type']) && $data['type']=='poster'){
            $vacancy = Vacancy::where('poster_user_id', '=', \Auth::user()->id);
        } else if(isset($data['type']) && $data['type']=='supplier'){
            $vacancy = Vacancy::whereHas('asSupplier', function($query) use($user_id){
                $query->where('supplier_user_id', $user_id)->where('status',1);
            });
        }

        if(isset($data['search']) && $data['search']!=''){
            $vacancy->where(function ($query) use($data){
                $query->orWhere('vacancies.name', 'like', '%'.$data['search'].'%');
                $query->orWhere('target_companies', 'like', '%'.$data['search'].'%');
                $query->orWhere('off_limits_companies', 'like', '%'.$data['search'].'%');
                $query->orWhere('responsabilities', 'like', '%'.$data['search'].'%');
                $query->orWhere('required_experience', 'like', '%'.$data['search'].'%');
            });
        }

        if(isset($data['country_id']) && $data['country_id']!=''){
            $vacancy->where('country_id', $data['country_id']);
        }

        if(isset($data['state_id']) && $data['state_id']!=''){
            $vacancy->where('state_id', $data['state_id']);
        }

        if(isset($data['city_id']) && $data['city_id']!=''){
            $vacancy->where('city_id', $data['city_id']);
        }

        if(isset($data['industry']) && $data['industry']!=''){
            $vacancy->where('industry', $data['industry']);
        }

        if(isset($data['periods']) && $data['periods']!=''){
            $vacancy->where('vacancies.created_at', '>=', Carbon::now()->subDays($data['periods'])->format('Y-m-d'));
        }

        if(isset($data['order']) && $data['order']!='suppliers_cant'){
            $vacancy->orderBy($data['order'], 'desc');
        } else {
            $vacancy->orderBy('vacancies.created_at', 'desc');
        }
        if(isset($data['type']) && $data['type']!='find') {
            if (isset($data['page']) && $data['page'] != '') {
                $vacancy->offset(($data['page'] - 1) * $perPage);
            }
            $vacancy->limit($perPage);
        }

        return ['count'=> $vacancy->count(), 'data' => $vacancy->get()];
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $vacancy = Vacancy::create($data);

        event(new Created($vacancy));

        return $vacancy;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $vacancy = $this->find($id);

        $vacancy->update($data);

        Cache::flush();

        event(new Updated($vacancy));

        return $vacancy;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $vacancy = $this->find($id);
        
        event(new Deleted($vacancy));

        $status = $vacancy->delete();

        Cache::flush();

        return $status;
    }
    
    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return Vacancy::where($column, '=', $id)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function address($id){

        $vacancy = $this->find($id);

        return $vacancy->address();
    }

    /**
     * {@inheritdoc}
     */
    public function languages($id){

        $vacancy = $this->find($id);

        return $vacancy->languages();
    }

    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return Vacancy::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function supplier($id){

        $vacancy = $this->find($id);

        return $vacancy->supplier();
    }

    /**
     * {@inheritdoc}
     */
    public function candidates($id){

        $vacancy = $this->find($id);

        return $vacancy->candidates();
    }

    /**
     * {@inheritdoc}
     */
    public function createContract($id){

        $vacancy = $this->find($id);

        return $vacancy->createContract();
    }

    /**
     * {@inheritdoc}
     */
    public function invoices($id){

        $vacancy = $this->find($id);

        return $vacancy->invoices();
    }

    /**
     * {@inheritdoc}
     */
    public function getOpportunities($column, $id,$perPage)
    {
        return Vacancy::where($column, '<>', $id)->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function lastestOpportunities($column, $id, $count)
    {
        return Vacancy::where($column, '<>', $id)->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function lastestPoster($column, $id, $count)
    {
        return Vacancy::where($column, '=', $id)->where('general_conditions', '!=', '')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
    */
    public function getSupplier($table1, $campo1, $id1,$table2, $campo2,$id2, $campo3, $campo4,$campo5,$campo6, $campo7,$campo8, $poster_user_id){
        return Vacancy::join($table1, $id1, '=', $campo1)
        ->join($table2,$id2,'=',$campo2)
            ->where($campo3, '=',$poster_user_id )->where($campo5,'=',$campo6)
            ->select($campo8,$campo4,$campo7)
            ->get();
        /*
            Vacancy::join('vacancy_users', 'vacancies.id', '=', 'vacancy_users.vacancy_id')
        ->join('users','vacancy_users.supplier_user_id','=','users.id')
            ->where('vacancies.poster_user_id', '=',$poster_user_id )
            ->select('users.*')
            ->get();
        */
    }    
}
