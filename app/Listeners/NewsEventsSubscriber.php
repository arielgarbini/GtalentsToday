<?php

namespace Vanguard\Listeners;

use Vanguard\Activity;
use Vanguard\Events\News\Created;
use Vanguard\Events\News\Deleted;
use Vanguard\Events\News\Updated;
use Vanguard\Services\Logging\UserActivity\Logger;

class NewsEventsSubscriber
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
        $news = trans('log.new_news');

        $this->logger->log($news);
    }

    public function onUpdate(Updated $event)
    {
        $news = trans('log.updated_news');

        $this->logger->log($news);
    }

    public function onDelete(Deleted $event)
    {
        $news = trans('log.deleted_news');

        $this->logger->log($news);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Vanguard\Listeners\NewsEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
