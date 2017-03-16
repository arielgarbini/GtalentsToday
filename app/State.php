<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo('Vanguard\Country','country_id');
    }

}
