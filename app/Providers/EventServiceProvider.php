<?php

namespace Vanguard\Providers;

use Vanguard\Events\User\Registered;
use Vanguard\Listeners\CandidateEventsSubscriber;
use Vanguard\Listeners\CategoryEventsSubscriber;
use Vanguard\Listeners\CompanyEventsSubscriber;
use Vanguard\Listeners\PermissionEventsSubscriber;
use Vanguard\Listeners\RoleEventsSubscriber;
use Vanguard\Listeners\UserEventsSubscriber;
use Vanguard\Listeners\UserWasRegisteredListener;
use Vanguard\Listeners\VacancyEventsSubscriber;
use Vanguard\Listeners\VacancyLogEventsSubscriber;
use Vanguard\Listeners\ConditionEventsSubscriber;
use Vanguard\Listeners\MessageEventsSubscriber;
use Vanguard\Listeners\NewsEventsSubscriber;
use Vanguard\Listeners\PointEventsSubscriber;
use Vanguard\Listeners\NotificationEventsSuscriber;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Vanguard\Events\NotificationEvent' => [
            'Vanguard\Listeners\NotificationEventsSuscriber',
        ],
        'Vanguard\Events\RankingEvent' => [
            'Vanguard\Listeners\RankingEventsSubscriber',
        ],
        //Registered::class => [UserWasRegisteredListener::class]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventsSubscriber::class,
        RoleEventsSubscriber::class,
        PermissionEventsSubscriber::class,
        CandidateEventsSubscriber::class,
        CategoryEventsSubscriber::class,
        CompanyEventsSubscriber::class,
        VacancyEventsSubscriber::class,
        VacancyLogEventsSubscriber::class,
        ConditionEventsSubscriber::class,
        MessageEventsSubscriber::class,
        NewsEventsSubscriber::class,
        PointEventsSubscriber::class
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
