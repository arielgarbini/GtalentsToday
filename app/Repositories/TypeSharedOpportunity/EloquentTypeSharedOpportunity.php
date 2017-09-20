<?php

namespace Vanguard\Repositories\TypeSharedOpportunity;

use Vanguard\TypeSharedOpportunity;
use DB;

class EloquentTypeSharedOpportunity implements TypeSharedOpportunityRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return TypeSharedOpportunity::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return TypeSharedOpportunity::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $type = TypeSharedOpportunity::create($data);

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
        return TypeSharedOpportunity::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
