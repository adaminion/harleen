<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class InitialViewShare
{
    /**
     * Handle an incoming request, and also initial any view share.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('workingAreaId', Auth::user()->working_area_id);

        return $next($request);
    }
}
