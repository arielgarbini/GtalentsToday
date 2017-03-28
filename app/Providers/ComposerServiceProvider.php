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
            '*', 'Vanguard\Http\Viewcomposers\NotificationComposer'
        );

        View::composer(
            ['dashboard_user/post/post_detail', 'dashboard_user/post/post_user', 'dashboard_user/post/post_supplier'],
            'Vanguard\Http\Viewcomposers\VacancyComposer'
        );

        View::composer(
            ['dashboard_user/candidate/index', 'dashboard_user/post/post_supplier'],
            'Vanguard\Http\Viewcomposers\CandidateComposer'
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
