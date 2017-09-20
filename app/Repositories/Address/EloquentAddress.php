<?php

namespace Vanguard\Repositories\Address;

use Vanguard\Address;
use Cache;
use DB;

class EloquentAddress implements AddressRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Address::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Address::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Address::query();

        if ($status) {
            $query->where('is_active', $status);
        }

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('address', "like", "%{$search}%");
                $q->orWhere('zip_code', 'like', "%{$search}%");
                $q->orWhere('city', 'like', "%{$search}%");
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
        $type = Address::create($data);

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
    public function lists($language = '1', $column = 'name', $key = 'id')
    {
        return Address::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
