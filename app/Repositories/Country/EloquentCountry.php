<?php

namespace Vanguard\Repositories\Country;

use Vanguard\Country;
use DB;

class EloquentCountry implements CountryRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Country::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        if($column == 'currency_code')
            return Country::where($column,'!=', null)->where($column,'!=', '')->orderBy($column)->groupBy($column)->lists($column, $key);

        return Country::orderBy($column)->lists($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function states($id){

        $country = $this->find($id);

        return $country->states();
    }
}