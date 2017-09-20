<?php

namespace Vanguard\Repositories\FunctionalArea;

use Vanguard\FunctionalArea;
use DB;

class EloquentFunctionalArea implements FunctionalAreaRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return FunctionalArea::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return FunctionalArea::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $area = FunctionalArea::create($data);

      //  event(new Created($area));

        return $area;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $area = $this->find($id);

        $area->update($data);

        Cache::flush();

        //event(new Updated($area));

        return $area;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $area = $this->find($id);

        //event(new Deleted($area));

        $status = $area->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return FunctionalArea::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
