<?php

namespace Vanguard\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*', 'Vanguard\Http\ViewComposers\NotificationComposer'
        );

        View::composer(
            ['dashboard_user/post/post_detail', 'dashboard_user/post/post_user', 'dashboard_user/post/post_supplier'],
            'Vanguard\Http\ViewComposers\VacancyComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
