<?php

namespace Vanguard\Events\Experience;

use Vanguard\Experience;

abstract class ExperienceEvent
{
    /**
     * @var Experience
     */
    protected $experience;

    public function __construct(Experience $experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return Experience
     */
    public function getExperience()
    {
        return $this->experience;
    }
}
