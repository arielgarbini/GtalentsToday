<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    protected $table = 'jobtitles';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'value_id',
        'language_id',
        'name'
    ];

}
