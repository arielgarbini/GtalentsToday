<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyStatus extends Model
{
    use SoftDeletes;

    protected $table = 'vacancy_status';

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
        return VacancyStatus::where('value_id', $id)->where('language_id', $lang)->first();
    }
}
