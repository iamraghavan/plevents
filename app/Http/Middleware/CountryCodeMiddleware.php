<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CountryCodeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Fetch location information based on the client's IP address
        $location = $this->getLocationInfo();

        // Check if the location data retrieval was successful and contains the 'country' key
        if ($location['status'] === 'success' && !empty($location['data']['country'])) {
            $countryCode = strtolower($location['data']['country']);

            // Check if the URL already contains the country code
            if (!$request->is("$countryCode/*") && $request->path() !== "$countryCode") {
                // Redirect to the URL with the country code
                return redirect("/$countryCode" . $request->getRequestUri());
            }
        }

        return $next($request);
    }

    private function getLocationInfo()
    {
        try {
            // Fetch location information from IPinfo API
            $url = 'https://ipinfo.io/json';
            $response = Http::get($url);

            // Check if the response is successful
            if ($response->successful()) {
                $data = $response->json();

                // Ensure 'country' key exists in the response data
                if (isset($data['country'])) {
                    return [
                        'status' => 'success',
                        'data' => $data
                    ];
                } else {
                    // Handle missing 'country' key
                    return [
                        'status' => 'error',
                        'message' => 'Country information is not available.'
                    ];
                }
            } else {
                // Handle unsuccessful response
                return [
                    'status' => 'error',
                    'message' => 'Unable to retrieve location data.'
                ];
            }
        } catch (\Throwable $th) {
            // Handle exceptions
            Log::error('Error retrieving location data: ', ['exception' => $th]);

            return [
                'status' => 'error',
                'message' => 'An error occurred while retrieving location data.'
            ];
        }
    }
}