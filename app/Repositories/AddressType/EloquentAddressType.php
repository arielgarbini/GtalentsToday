<?php

namespace Vanguard\Repositories\AddressType;

use Vanguard\AddressType;
use Cache;
use DB;

class EloquentAddressType implements AddressTypeRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return AddressType::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return AddressType::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = AddressType::query();

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
        $type = AddressType::create($data);

        return $type;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $type = $this->find($id);

        $type->update($data);

        Cache::flush();

        return $type;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $type = $this->find($id);

        $status = $type->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return AddressType::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
