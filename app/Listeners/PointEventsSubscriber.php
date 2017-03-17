<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Point\Created;
use Vanguard\Events\Point\Deleted;
use Vanguard\Events\Point\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class PointEventsSubscriber
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
        $point = $event->getPoint();

        $name = $point->name;
        $message = trans('log.new_point', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $point = $event->getPoint();

        $name = $point->name;
        $message = trans('log.updated_point', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $point = $event->getPoint();

        $name = $point->name;
        $message = trans('log.deleted_point', ['name' => $name]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\PointEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}