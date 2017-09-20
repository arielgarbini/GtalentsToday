<?php

namespace Vanguard\Repositories\Condition;

use Vanguard\Events\Condition\Created;
use Vanguard\Events\Condition\Updated;
use Vanguard\Events\Condition\Deleted;
use Cache;
use Vanguard\Condition;
use DB;

class EloquentCondition implements ConditionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all($id = '')
    {        
        return Condition::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Condition::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $condition = Condition::create($data);

        event(new Created($condition));

        return $condition;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $condition = $this->find($id);

        $condition->update($data);

        Cache::flush();

        event(new Updated($condition));

        return $condition;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $condition = $this->find($id);
        
        event(new Deleted($condition));

        $status = $condition->delete();

        Cache::flush();

        return $status;
    }
    
    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return Condition::where($column, '=', $id)->get();
    }
}
