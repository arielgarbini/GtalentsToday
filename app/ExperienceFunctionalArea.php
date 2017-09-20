<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ExperienceFunctionalArea extends Model
{
    protected $table = 'experience_functional_areas';

    public $timestamps = false;

    protected $fillable = ['experience_id', 'functional_area_id'];

    public function functional($language)
    {
        return FunctionalArea::where('value_id', $this->functional_area_id)->where('language_id', $language)->get()->first();
    }
}
