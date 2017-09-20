<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class TypeInvolvedOpportunityProfile extends Model
{
    protected $table = 'type_of_involved_opportunities_profile';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['profile_id', 'type_of_involved_opportunities_id'];

    public function name($language)
    {
        return TypeInvolvedOpportunity::where('value_id', $this->type_of_involved_opportunities_id)->where('language_id', $language)->get()->first();
    }
}
