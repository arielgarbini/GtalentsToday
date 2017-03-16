<?php

namespace Vanguard\Events\Vacancy;

use Vanguard\Vacancy;

abstract class VacancyEvent
{
    /**
     * @var Vacancy
     */
    protected $vacancy;

    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * @return Vacancy
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }
}
