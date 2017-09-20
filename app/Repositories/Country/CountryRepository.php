<?php

namespace Vanguard\Repositories\Country;

interface CountryRepository
{

    /**
     * Finds the promotion by given id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create $key => $value array for all available countries.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($column = 'name', $key = 'id');

    /**
     * Finds the promotion by given id.
     *
     * @param $id
     * @return mixed
     */
    public function states($id);
}