<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyCandidate extends Model
{
    use SoftDeletes;

    protected $table = 'vacancy_candidates';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'vacancy_id', 
    						'candidate_id', 
    						'status',
                            'comment'
    					];

    public function vacacy()
    {
        return $this->BelongsTo(Vacancy::class, 'vacancy_id');
    }

    public function candidate()
    {
        return $this->BelongsTo(Candidate::class, 'candidate_id');
    }

}
