<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Vacancy\Applied;
use Vanguard\Events\Vacancy\Created;
use Vanguard\Events\Vacancy\Deleted;
use Vanguard\Events\Vacancy\Updated;
use Vanguard\Events\Vacancy\UpdatedSupplier;
use Vanguard\Events\Vacancy\UpdatedCandidate;
use Vanguard\Events\Vacancy\Viewed;
use Vanguard\Services\Logging\UserActivity\Logger;

class VacancyEventsSubscriber
{
    /**
     * @var UserActivityLogger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $vacancy = $event->getVacancy();

        $name = $vacancy->name;
        $message = trans('log.new_vacancy', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $vacancy = $event->getVacancy();

        $name = $vacancy->name;
        $message = trans('log.updated_vacancy', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $vacancy = $event->getVacancy();

        $name = $vacancy->name;
        $message = trans('log.deleted_vacancy', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onView(Viewed $event)
    {
        $vacancy = $event->getVacancy();

        $name = 'v:'.$vacancy->id.':';
        $message = trans('log.viewed_vacancy', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onApply(Applied $event)
    {
        $vacancy = $event->getVacancy();

        $name = ' :'.$vacancy->id.':';
        $message = trans('log.applied_vacancy', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdateSupplier(UpdatedSupplier $event)
    {
        $vacancy = $event->getVacancy();

        $supplier = $event->getSupplier();
        $message = trans('log.'.$event->getStatus().'_supplier', ['vacancy' => $vacancy, 'supplier' => $supplier]);

        $this->logger->log($message);
    }

    public function onUpdateCandidate(UpdatedCandidate $event)
    {
        $vacancy = $event->getVacancy();

        $candidate = $event->getCandidate();
        $message = trans('log.'.$event->getStatus().'_candidate', ['vacancy' => $vacancy, 'candidate' => $candidate]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\VacancyEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
        $events->listen(Viewed::class, "{$class}@onView");
        $events->listen(Applied::class, "{$class}@onApply");
        $events->listen(UpdatedSupplier::class, "{$class}@onUpdateSupplier");
        $events->listen(UpdatedCandidate::class, "{$class}@onUpdateCandidate");
    }
}
