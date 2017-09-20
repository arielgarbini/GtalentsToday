<?php

namespace Vanguard\Events\VacancyUser;

use Vanguard\VacancyUser;

abstract class VacancyUserEvent
{
    /**
     * @var Vacancy
     */
    protected $vacancy;

    public function __construct(VacancyUser $vacancy_user)
    {
        $this->vacancy_user = $vacancy_user;
    }

    /**
     * @return Vacancy
     */
    public function getVacancyUser()
    {
        return $this->vacancy_user;
    }
}
