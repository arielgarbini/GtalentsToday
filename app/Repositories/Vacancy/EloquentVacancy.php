<?php

namespace Vanguard\Repositories\Vacancy;

use Vanguard\Events\Vacancy\Created;
use Vanguard\Events\Vacancy\Deleted;
use Vanguard\Events\Vacancy\Updated;
use Cache;
use Vanguard\Vacancy;
use DB;

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
