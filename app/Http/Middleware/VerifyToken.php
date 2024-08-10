<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class VerifyToken
{
    public function handle($request, Closure $next)
    {
        // Assuming the token is stored in the session
        $token = Session::get('auth_token');

        // If the token does not exist, generate and store it in the session
        if (!$token) {
            $token = bin2hex(random_bytes(6)); // Example token generation
            Session::put('auth_token', $token);
        }

        // Check if the current URL already contains the correct token
        $currentPath = $request->path();
        $tokenInPath = last(explode('/', $currentPath));

        if ($tokenInPath !== $token) {
            // If the token is not in the path, redirect with the token appended
            $newUrl = rtrim($request->url(), '/') . '/' . $token;
            return redirect($newUrl);
        }

        return $next($request);
    }
}