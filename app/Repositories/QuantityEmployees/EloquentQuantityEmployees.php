<?php

namespace Vanguard\Repositories\QuantityEmployees;

use Vanguard\QuantityEmployees;
use DB;

class EloquentQuantityEmployees implements QuantityEmployeesRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return QuantityEmployees::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return QuantityEmployees::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $quantity = QuantityEmployees::create($data);

      //  event(new Created($quantity));

        return $quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $quantity = $this->find($id);

        $quantity->update($data);

        Cache::flush();

        //event(new Updated($quantity));

        return $quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $quantity = $this->find($id);

        //event(new Deleted($quantity));

        $status = $quantity->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return QuantityEmployees::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
