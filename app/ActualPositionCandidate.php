<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActualPositionCandidate extends Model
{
    use SoftDeletes;

    protected $table = 'actual_positions_candidates';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = ['value_id', 'name', 'language_id'];

    /**
     * {@inheritdoc}
     */
    public function getNameLang(int $id) {

        if(session('lang') == 'es')
            $lang = 1;
        else $lang = 2;
        return ActualPositionCandidate::where('value_id', $id)->where('language_id', $lang)->first();
    }
}
