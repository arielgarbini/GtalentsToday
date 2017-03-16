<?php

namespace Vanguard\Repositories\SchemeWork;

use Vanguard\SchemeWork;
use Cache;
use DB;

class EloquentSchemeWork implements SchemeWorkRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return SchemeWork::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return SchemeWork::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = SchemeWork::query();

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
        $scheme = SchemeWork::create($data);

        return $scheme;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $scheme = $this->find($id);

        $scheme->update($data);

        Cache::flush();

        return $scheme;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $scheme = $this->find($id);

        $status = $scheme->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return SchemeWork::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
