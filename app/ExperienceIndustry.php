<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ExperienceIndustry extends Model
{
    protected $table = 'experience_industries';

    public $timestamps = false;

    protected $fillable = ['experience_id', 'industry_id'];

    public function industry($language)
    {
        return Industry::where('value_id', $this->industry_id)->where('language_id', $language)->get()->first();
    }

}
