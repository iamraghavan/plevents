<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        // Log incoming request data for debugging
        Log::info('Google Callback Request Data:', $request->all());

        // Validate the incoming request data
        $request->validate([
            'google_uid' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'profile_picture' => 'nullable|url'
        ]);

        try {
            // Update or create a user with the provided data
            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'profile_url' => $request->profile_picture,
                    'password' => bcrypt($request->google_uid), // Password is set to google_uid for simplicity
                    'is_admin' => 0,
                    'roles' => 'user',
                    'google_id' => $request->google_uid
                ]
            );

            // Log the successful creation or update
            Log::info('User created or updated successfully', ['user_id' => $user->id]);

            // Log in the user
            Auth::login($user);

            // Store Google UID in the session
            session(['google_uid' => $request->google_uid]);

            // Log the session storage success
            Log::info('Google UID stored in session', ['google_uid' => $request->google_uid]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Google Callback Error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception_trace' => $e->getTraceAsString()
            ]);

            // Return a 500 error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
}