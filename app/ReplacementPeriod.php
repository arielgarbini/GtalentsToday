<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReplacementPeriod extends Model
{
    use SoftDeletes;

    protected $table = 'replacement_periods';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'name', 'language_id'];

    /**
     * {@inheritdoc}
     */
    public function getNameLang($id) {

        if(session('lang') == 'es')
            $lang = 1;
        else $lang = 2;
        return ReplacementPeriod::where('value_id', $id)->where('language_id', $lang)->first();
    }
}
