<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\Category\Created;
use Vanguard\Events\Category\Deleted;
use Vanguard\Events\Category\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class CategoryEventsSubscriber
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
        $category = $event->getCategory();

        $name = $category->name;
        $message = trans('log.new_category', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $category = $event->getCategory();

        $name = $category->name;
        $message = trans('log.updated_category', ['name' => $name]);

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $category = $event->getCategory();

        $name = $category->name;
        $message = trans('log.deleted_category', ['name' => $name]);

        $this->logger->log($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\CategoryEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
