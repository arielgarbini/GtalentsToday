<?php
namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanguageVacancy extends Model
{
    protected $table = 'language_vacancy';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['vacancy_id', 'type_id', 'level'];

    public function type($l)
    {
        return LanguageType::where('language_id', $l)->where('value_id', $this->type_id)->get()->first()->name;
    }
}
