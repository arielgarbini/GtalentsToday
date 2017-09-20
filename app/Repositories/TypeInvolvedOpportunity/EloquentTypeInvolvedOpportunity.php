<?php

namespace Vanguard\Repositories\TypeInvolvedOpportunity;

use Vanguard\TypeInvolvedOpportunity;
use DB;

class EloquentTypeInvolvedOpportunity implements TypeInvolvedOpportunityRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return TypeInvolvedOpportunity::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return TypeInvolvedOpportunity::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $type = TypeInvolvedOpportunity::create($data);

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
        return TypeInvolvedOpportunity::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
