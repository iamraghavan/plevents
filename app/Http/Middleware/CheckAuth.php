<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
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
        // Exclude the Google callback route from the authentication check
        if (!Auth::guard('web')->check() && !$request->is('auth/google/callback')) {
            return redirect()->route('google.callback');
        }

        return $next($request);
    }
}