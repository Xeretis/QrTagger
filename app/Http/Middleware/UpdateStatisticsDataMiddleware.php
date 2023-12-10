<?php

namespace App\Http\Middleware;

use App\Jobs\UpdateStatisticsDataJob;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateStatisticsDataMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            UpdateStatisticsDataJob::dispatch(Auth::user(), $request->ip());
        }

        return $next($request);
    }
}
