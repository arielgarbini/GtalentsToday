<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class TypeInvolvedSearchProfile extends Model
{
    protected $table = 'type_of_involved_search_profile';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['profile_id', 'type_of_involved_search_id'];

    public function name($language)
    {
        return TypeInvolvedSearch::where('value_id', $this->type_of_involved_search_id)->where('language_id', $language)->get()->first();
    }
}
