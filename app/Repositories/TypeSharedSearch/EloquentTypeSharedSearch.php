<?php

namespace Vanguard\Repositories\TypeSharedSearch;

use Vanguard\TypeSharedSearch;
use DB;

class EloquentTypeSharedSearch implements TypeSharedSearchRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return TypeSharedSearch::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return TypeSharedSearch::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $type = TypeSharedSearch::create($data);

      //  event(new Created($type));

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

        //event(new Updated($type));

        return $type;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $type = $this->find($id);

        //event(new Deleted($type));

        $status = $type->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return TypeSharedSearch::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
