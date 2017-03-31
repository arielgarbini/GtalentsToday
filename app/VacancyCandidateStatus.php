<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class VacancyCandidateStatus extends Model
{
    const UPDATED_AT = null;

    protected $table = 'vacancy_candidates_status';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['vacancy_id', 'candidate_id', 'status'];

    public function vacancy()
    {
        return $this->BelongsTo(Vacancy::class, 'vacancy_id');
    }

    public function candidate()
    {
        return $this->BelongsTo(Candidate::class, 'candidate_id');
    }
}
