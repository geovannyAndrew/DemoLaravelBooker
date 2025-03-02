<?php

namespace App\Http\Middleware;

use Closure;

class RenterMiddleware
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
        if ($request->user() && !$request->user()->is_renter){
            return response("Unauthorized", 403);
        }
        return $next($request);
    }
}
