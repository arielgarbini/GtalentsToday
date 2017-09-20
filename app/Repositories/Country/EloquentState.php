<?php

namespace Vanguard\Repositories\Country;

use Vanguard\State;

class EloquentState implements StateRepository
{
    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return State::orderBy('name')->lists($column, $key);
    }
}
