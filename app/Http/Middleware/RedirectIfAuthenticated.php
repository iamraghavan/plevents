<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            // Ensure the user is authenticated and is an admin
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                // Log out non-admin users who are authenticated
                Auth::guard($guard)->logout();

                return redirect()->route('login')->withErrors([
                    'restricted_area' => 'Access denied. Only Event Organization can access this area.',
                ]);
            }
        }

        return $next($request);
    }
}
