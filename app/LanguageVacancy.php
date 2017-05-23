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

    public function level()
    {
        if($this->level==1){
            return \Lang::get('app.native');
        } else if($this->level==2){
            return \Lang::get('app.fluent');
        } else if($this->level==3){
            return \Lang::get('app.good');
        } else if($this->level==4) {
            return \Lang::get('app.functional');
        } else if($this->level==5) {
            return \Lang::get('app.basic');
        }
    }
}
