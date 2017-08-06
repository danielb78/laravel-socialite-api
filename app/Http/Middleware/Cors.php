<?php

namespace lsa\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', env('CORS_DOMAIN', '*'))
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, User-Agent')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
