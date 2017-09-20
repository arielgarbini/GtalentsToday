<?php

namespace Vanguard\Events\Vacancy;

use Vanguard\Candidate;
use Vanguard\Vacancy;

abstract class VacancyLogEvent
{
    /**
     * @var Vacancy
     */
    protected $vacancy;
    /**
     * @var Candidate
     */
    protected $candidate;

    public function __construct(Vacancy $vacancy, Candidate $candidate = null)
    {
        $this->vacancy = $vacancy;
        $this->candidate = $candidate;
    }

    /**
     * @return Vacancy
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @return Vacancy
     */
    public function getCandidate()
    {
        return $this->candidate;
    }
}
