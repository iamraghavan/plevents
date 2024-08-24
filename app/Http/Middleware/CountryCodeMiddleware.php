<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CountryCodeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Fetch IP details from the API
        $ipInfo = file_get_contents("https://ipinfo.io/json");
        $details = json_decode($ipInfo, true);

        // Extract the country code and region, or set default values
        $countryCode = isset($details['country']) ? strtolower($details['country']) : null;

        // Proceed if country code is available
        if ($countryCode) {
            $currentPath = $request->path();

            // Check if the country code is already in the URL path
            if (!str_contains($currentPath, $countryCode)) {
                // Redirect to the path with the country code at the end if not already present
                $newPath = rtrim($currentPath, '/') . '/' . $countryCode;
                return redirect($newPath);
            }
        }

        return $next($request);
    }
}