<?php

namespace Vanguard\Repositories\ActualPosition;

use Vanguard\ActualPosition;
use DB;

class EloquentActualPosition implements ActualPositionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ActualPosition::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ActualPosition::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $actual = ActualPosition::create($data);

      //  event(new Created($actual));

        return $actual;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $actual = $this->find($id);

        $actual->update($data);

        Cache::flush();

        //event(new Updated($actual));

        return $actual;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $actual = $this->find($id);

        //event(new Deleted($actual));

        $status = $actual->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return ActualPosition::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
