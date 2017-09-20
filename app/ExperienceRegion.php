<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ExperienceRegion extends Model
{
    protected $table = 'experience_regions';

    public $timestamps = false;

    protected $fillable = ['experience_id', 'region_id'];

    public function region($language)
    {
        return Region::where('value_id', $this->region_id)->where('language_id', $language)->get()->first();
    }
}
