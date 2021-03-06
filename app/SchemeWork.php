<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchemeWork extends Model
{
    use SoftDeletes;

    protected $table = 'scheme_works';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'name', 
    						'description', 
    						'language_id', 
    						'value_id'
    					];

    /**
     * {@inheritdoc}
     */
    public function getNameLang(int $id) {

        if(session('lang') == 'es')
            $lang = 1;
        else $lang = 2;
        return SchemeWork::where('value_id', $id)->where('language_id', $lang)->first();
    }
}
