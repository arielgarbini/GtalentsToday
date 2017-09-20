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
                            'years_experience_id',
                            'user_id',
                            'current_company',
                            'jobtitle_id',
                            'reference_job',
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
        return $this->hasOne(TypeSharedSearchProfile::class, 'profile_id');
    }

    public function type_of_involved_search()
    {
        return $this->hasOne(TypeInvolvedSearchProfile::class, 'profile_id');
    }

    public function type_of_shared_opportunity()
    {
        return $this->hasOne(TypeSharedOpportunityProfile::class, 'profle_id');
    }

    public function type_of_involved_opportunity()
    {
        return $this->hasOne(TypeInvolvedOpportunityProfile::class, 'profile_id');
    }
}
