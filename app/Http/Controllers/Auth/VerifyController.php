<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VerifyController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Check if the user is an admin
            if ($user->is_admin) {
                $hashedValue = Hash::make($user->email . now());
                $encodedToken = base64_encode($hashedValue);
                $request->session()->put('admin_auth_token', $encodedToken);


                return redirect()->route('admin.dashboard', ['token' => $encodedToken, 'login_success' => 'true']);
            } else {
                // If the user is not an admin, log them out and show an error
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'restricted_area' => 'Only authorized Event Organizers have access to this area. Please ensure you have the correct permissions.',
                ]);
            }
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
