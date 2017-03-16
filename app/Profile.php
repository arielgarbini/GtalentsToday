<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'company_id', 
    						'linkedin_url',
    						'availability',
    						'size',
    						'points',
    						'actual_position_id',
    						'profile_position_id',
    						'type_of_shared_search_id',
    						'type_of_involved_search_id',
    						'type_of_shared_opportunity_id',
    						'type_of_involved_opportunity_id'
    					];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function actual_position()
    {
        return $this->hasOne(ActualPosition::class, 'id', 'actual_position_id');
    }

    public function profile_position()
    {
        return $this->hasOne(ProfilePosition::class, 'id', 'profile_position_id');
    }

    public function type_of_shared_search()
    {
        return $this->hasOne(TypeSharedSearch::class, 'id', 'type_of_shared_search_id');
    }

    public function type_of_involved_search()
    {
        return $this->hasOne(TypeInvolvedSearch::class, 'id', 'type_of_involved_search_id');
    }

    public function type_of_shared_opportunity()
    {
        return $this->hasOne(TypeSharedOpportunity::class, 'id', 'type_of_shared_opportunity_id');
    }

    public function type_of_involved_opportunity()
    {
        return $this->hasOne(TypeInvolvedOpportunity::class, 'id', 'type_of_involved_opportunity_id');
    }
}
