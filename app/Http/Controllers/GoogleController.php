<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\EventUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class GoogleController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        Log::info('Google callback hit');

        try {
            $googleUid = $request->input('google_uid');
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $email = $request->input('email');
            $profilePicture = $request->input('profile_picture');

            Log::info('Data received: ', [
                'googleUid' => $googleUid,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'profilePicture' => $profilePicture
            ]);

            $user = EventUser::firstOrCreate(
                ['google_uid' => $googleUid],
                [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'profile_picture' => $profilePicture,
                    'google_uid' => $googleUid,
                    'local_uid' => Str::uuid()->toString()
                ]
            );

            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            Log::error('Error during Google callback: ', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
