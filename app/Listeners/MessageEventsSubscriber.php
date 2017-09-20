<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Message\Created;
use Vanguard\Events\Message\Deleted;
use Vanguard\Events\Message\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class MessageEventsSubscriber
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
        $message = trans('log.new_message');

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $message = trans('log.updated_message');

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $message = trans('log.deleted_message');

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\MessageEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
