<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Candidate\Created;
use Vanguard\Events\Candidate\Deleted;
use Vanguard\Events\Candidate\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class CandidateEventsSubscriber
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
        $candidate = $event->getCandidate();

        $name = $candidate->first_name .' '. $candidate->last_name;
        $message = trans('log.new_candidate', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $candidate = $event->getCandidate();

        $name = $candidate->first_name .' '. $candidate->last_name;
        $message = trans('log.updated_candidate', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $candidate = $event->getCandidate();

        $name = $candidate->first_name .' '. $candidate->last_name;
        $message = trans('log.deleted_candidate', ['name' => $name]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\CandidateEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
