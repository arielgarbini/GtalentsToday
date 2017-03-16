<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public $timestamps = false;


    /**
     * Relationships states
     *
     */
    public function states()
    {
        return $this->hasMany('Vanguard\State','country_id');
    }
}