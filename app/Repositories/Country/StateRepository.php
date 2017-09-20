<?php

namespace Vanguard\Repositories\Country;

interface StateRepository
{
    /**
     * Create $key => $value array for all available states.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id');
}