<?php

namespace Vanguard\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!empty(session('lang'))) {
            \App::setLocale(session('lang'));
            Carbon::setLocale(session('lang'));
        }
        return $next($request);
    }
}
