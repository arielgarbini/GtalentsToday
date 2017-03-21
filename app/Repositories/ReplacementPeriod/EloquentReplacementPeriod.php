<?php

namespace Vanguard\Repositories\ReplacementPeriod;

use Vanguard\ReplacementPeriod;
use Cache;
use DB;

class EloquentReplacementPeriod implements ReplacementPeriodRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ReplacementPeriod::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ReplacementPeriod::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = ReplacementPeriod::query();

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
        $replacement = ReplacementPeriod::create($data);

        return $replacement;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $replacement = $this->find($id);

        $replacement->update($data);

        Cache::flush();

        return $replacement;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $replacement = $this->find($id);

        $status = $replacement->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return ReplacementPeriod::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}