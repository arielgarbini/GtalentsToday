<?php

namespace Vanguard\Repositories\ContractType;

use Vanguard\ContractType;
use Cache;
use DB;

class EloquentContractType implements ContractTypeRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ContractType::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ContractType::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = ContractType::query();

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
        $contract = ContractType::create($data);

        return $contract;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $contract = $this->find($id);

        $contract->update($data);

        Cache::flush();

        return $contract;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $contract = $this->find($id);

        $status = $contract->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return ContractType::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
