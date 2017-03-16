<?php

namespace Vanguard\Events\Candidate;

use Vanguard\Candidate;

abstract class CandidateEvent
{
    /**
     * @var Candidate
     */
    protected $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * @return Candidate
     */
    public function getCandidate()
    {
        return $this->candidate;
    }
}
