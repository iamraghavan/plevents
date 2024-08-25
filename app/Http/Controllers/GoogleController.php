<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function checkAuth(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
        ]);

        $eventID = $request->event_id;

        // Store event ID and intended URL in the session
        session(['event_id' => $eventID]);

        if (Auth::check()) {
            return redirect()->route('register.check', ['id' => $eventID]);
        } else {
            // Store the intended URL in the session
            session(['url.intended' => url()->previous()]);
            return $this->redirectToGoogle();
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();

            $googleUid = $user->id;
            $email = $user->email;
            $name = $user->name;
            $profilePicture = $user->avatar;

            $existingUser = User::where('email', $email)->first();

            if ($existingUser) {
                $existingUser->update([
                    'name' => $name,
                    'profile_url' => $profilePicture,
                    'google_id' => $googleUid,
                ]);
                $user = $existingUser;
            } else {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'profile_url' => $profilePicture,
                    'password' => bcrypt($googleUid),
                    'google_id' => $googleUid,
                    'is_admin' => 0,
                    'roles' => 'user',
                ]);
            }

            Auth::login($user);

            session(['google_uid' => $googleUid]);

            // Retrieve event ID from the session
            $eventID = session('event_id');

            // Clear the event ID from the session
            session()->forget('event_id');

            // Redirect to the event registration page if event ID is found
            if ($eventID) {
                return redirect()->route('register.page', ['id' => $eventID]);
            }

            // Redirect to intended URL if available, else to home
            $intendedUrl = session('url.intended', '/');
            session()->forget('url.intended');
            return redirect($intendedUrl);

        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Failed to authenticate with Google.');
        }
    }

    public function logout(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Clear the session
            $request->session()->flush();

            // Clear all cookies
            $cookieNames = ['laravel_session', 'XSRF-TOKEN'];
            foreach ($cookieNames as $cookieName) {
                $request->cookies->remove($cookieName);
            }

            // Log out the user
            Auth::logout();
        }

        return redirect('/'); // Redirect to the homepage or a desired page if not authenticated
    }
}