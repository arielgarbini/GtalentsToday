<?php

namespace Vanguard\Listeners;

use Vanguard\VacancyLog;
use Vanguard\Events\Vacancy\Logged;
use Vanguard\Repositories\Vacancy\VacancyLogRepository;

class VacancyLogEventsSubscriber
{
    /**
     * @var VacancyLogRepository
     */
    private $vacancyLog;

    public function __construct(VacancyLogRepository $vacancyLog)
    {
        $this->vacancylogs = $vacancyLog;
    }

    public function onLog(Logged $event)
    {
        $candidate = '';
        if($event->getCandidate() !== null)
            $candidate = $event->getCandidate()->id;

        $vacancy = $event->getVacancy();

        $data = [   'vacancy_id'        => $vacancy->id,
                    'candidate_id'      => $candidate,
                    'name'              => $vacancy->name,
                    'description'       => $vacancy->description,
                    'positions_number'  => $vacancy->positions_number,
                    'scheme_work_id'    => $vacancy->scheme_work_id,
                    'responsabilities'  => $vacancy->responsabilities,
                    'experience'        => $vacancy->experience,
                    'file'              => $vacancy->file,
                    'key_points'        => $vacancy->key_points,
                    'minimum_salary'    => $vacancy->minimum_salary,
                    'maximum_salary'    => $vacancy->maximum_salary,
                    'career_plan'       => $vacancy->career_plan,
                    'contract_type_id'  => $vacancy->contract_type_id,
                    'sharing'           => $vacancy->sharing,
                    'vacancy_status_id' => $vacancy->vacancy_status_id,
                    'address_type_id'   => $vacancy->address->address_type_id,
                    'address'           => $vacancy->address->address,
                    'state_id'          => $vacancy->address->state_id,
                    'zip_code'          => $vacancy->address->zip_code,
                    'city'              => $vacancy->address->city,
                    ];
                    
        $this->vacancylogs->create($data);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\VacancyLogEventsSubscriber';

        $events->listen(Logged::class, "{$class}@onLog");
    }
}
