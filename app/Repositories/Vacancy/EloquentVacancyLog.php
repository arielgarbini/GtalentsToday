<?php

namespace Vanguard\Repositories\Vacancy;

use Cache;
use Vanguard\VacancyLog;
use DB;

class EloquentVacancyLog implements VacancyLogRepository
{
    /**
     * {@inheritdoc}
     */
    public function all($id = '')
    {        
        return VacancyLog::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return VacancyLog::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = VacancyLog::query();

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
        $vacancy = VacancyLog::create($data);

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

        return $vacancy;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $vacancy = $this->find($id);

        $status = $vacancy->delete();

        Cache::flush();

        return $status;
    }
    
    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return VacancyLog::where($column, '=', $id)->get();
    }
}
