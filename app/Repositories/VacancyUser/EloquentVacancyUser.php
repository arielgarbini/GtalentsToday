<?php

namespace Vanguard\Repositories\VacancyUser;

use Vanguard\Events\VacancyUser\Created;
use Vanguard\Events\VacancyUser\Deleted;
use Vanguard\Events\VacancyUser\Updated;
use Cache;
use Vanguard\VacancyUser;
use DB;

class EloquentVacancyUser implements VacancyUserRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {        
        return VacancyUser::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return VacancyUser::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = VacancyUser::query();

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
        $vacancy_user = VacancyUser::create($data);

        event(new Created($vacancy_user));

        return $vacancy_user;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $vacancy_user = $this->find($id);

        $vacancy_user->update($data);

        Cache::flush();

        event(new Updated($vacancy_user));

        return $vacancy_user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $vacancy_user = $this->find($id);
        
        event(new Deleted($vacancy_user));

        $status = $vacancy_user->delete();

        Cache::flush();

        return $status;
    }
    
    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return VacancyUser::where($column, '=', $id)->first();
    }

   public function updateStatusSupplier($id,$supplier_user_id, $status)
    {
        $data = [ 'status'     => $status,
                  'updated_at' => \Carbon\Carbon::now() ];

        $result = VacancyUser::where('vacancy_id', '=', $id)
                            ->where('supplier_user_id', '=', $supplier_user_id)
                            ->update($data);
                            
        return $result; 
    }

    public function countApplicationByStatus($status,$id)
    {
        $result = VacancyUser::where('vacancy_id', '=', $id)
                                ->where('status', '=', $status)
                                ->count();
        return $result;
    }
}
