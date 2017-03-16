<?php

namespace Vanguard\Events\Vacancy;

class UpdatedCandidate {

    /**
     * @var Integer
     */
    protected $vacancy;
    /**
     * @var Integer
     */
    protected $candidate;
    /**
     * @var Integer
     */
    protected $status;

    public function __construct($vacancy, $candidate, $status)
    {
        $this->vacancy = $vacancy;
        $this->candidate = $candidate;
        $this->status = $status;
    }

    /**
     * @return Vacancy
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @return CandidateId
     */
    public function getCandidate()
    {
        return $this->candidate;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return strtolower($this->status);
    }

}
