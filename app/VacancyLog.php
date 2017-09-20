<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyLog extends Model
{
    use SoftDeletes;

    protected $table = 'vacancy_logs';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'vacancy_id', 
    						'candidate_id',
    						'name', 
    						'description', 
    						'positions_number', 
    						'scheme_work_id', 
    						'responsabilities', 
    						'experience', 
    						'file',  
    						'key_points', 
    						'minimum_salary',
    						'maximum_salary',
    						'career_plan',
    						'contract_type_id',
    						'sharing',
    						'address_type_id',
                            'address',
                            'state_id',
                            'zip_code',
                            'city',
                            'is_active',
    						'vacancy_status_id',
    					];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class,'vacancy_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
