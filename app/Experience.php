<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [ 'company_id', 
    						'cases_number_id', 
    						'experience_years_id', 
    						'level_position_id'
    					];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function cases_numbers()
    {
        return $this->hasOne(CasesNumber::class, 'id', 'cases_number_id');
    }

    public function experience_years()
    {
        return $this->hasOne(ExperienceYear::class, 'id', 'experience_years_id');
    }

    public function level_positions()
    {
        return $this->hasOne(LevelPosition::class, 'id', 'level_position_id');
    }

    public function sectors(){
        return $this->belongsToMany(Sector::class,'experience_sectors');
    }

    public function industries(){
        return $this->belongsToMany(Industry::class,'experience_industries');
    }

    public function regions(){
        return $this->belongsToMany(Region::class,'experience_regions');
    }

    public function experience_roles(){
        return $this->belongsToMany(ExperienceRole::class,'experience_experience_roles');
    }

    public function functional_areas(){
        return $this->belongsToMany(FunctionalArea::class,'experience_functional_areas');
    }

    public function sourcing_networks(){
        return $this->belongsToMany(SourcingNetwork::class,'experience_sourcing_networks');
    }

    public function industries_all(){
        return $this->hasMany(ExperienceIndustry::class);
    }
}
