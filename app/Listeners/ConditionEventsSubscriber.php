<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Condition\Created;
use Vanguard\Events\Condition\Deleted;
use Vanguard\Events\Condition\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class ConditionEventsSubscriber
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
        $condition = $event->getCondition();

        $name = $condition->vacancy->name;
        $message = trans('log.new_condition', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $condition = $event->getCondition();

        $name = $condition->vacancy->name;
        $message = trans('log.updated_condition', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $condition = $event->getCondition();

        $name = $condition->vacancy->name;
        $message = trans('log.deleted_condition', ['name' => $name]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\ConditionEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
