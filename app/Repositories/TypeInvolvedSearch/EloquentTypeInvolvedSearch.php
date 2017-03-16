<?php

namespace Vanguard\Repositories\TypeInvolvedSearch;

use Vanguard\TypeInvolvedSearch;
use DB;

class EloquentTypeInvolvedSearch implements TypeInvolvedSearchRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return TypeInvolvedSearch::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return TypeInvolvedSearch::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $type = TypeInvolvedSearch::create($data);

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
        return TypeInvolvedSearch::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
