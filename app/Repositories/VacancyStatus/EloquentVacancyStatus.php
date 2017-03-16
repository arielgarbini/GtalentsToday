<?php

namespace Vanguard\Repositories\VacancyStatus;

use Vanguard\VacancyStatus;
use Cache;
use DB;

class EloquentVacancyStatus implements VacancyStatusRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return VacancyStatus::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return VacancyStatus::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = VacancyStatus::query();

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
        $vacancy = VacancyStatus::create($data);

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
    public function lists($language = '1', $column = 'name', $key = 'id')
    {
        return VacancyStatus::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
