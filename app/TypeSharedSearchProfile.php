<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class TypeSharedSearchProfile extends Model
{
    protected $table = 'type_of_shared_search_profile';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['profile_id', 'type_of_shared_search_id'];

    public function name($language)
    {
        return TypeSharedSearch::where('value_id', $this->type_of_shared_search_id)->where('language_id', $language)->get()->first();
    }
}
