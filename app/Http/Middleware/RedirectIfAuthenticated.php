<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if($user->is_renter){
                return redirect()->route('renter.bookings.index');
            }
            else if($user->is_user){
                return redirect()->route('user.grills_near');
            }
            else{
                return redirect()->route('user.grills_near');
            }
        }

        return $next($request);
    }
}
