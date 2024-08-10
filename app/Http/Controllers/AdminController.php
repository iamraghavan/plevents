<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard(Request $request, $token)
    {

        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        // Compare the decoded token with the session token
        if ($sessionToken !== $token) {
            // Handle invalid token scenario
            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        if (Auth::guard('admin')->check()) {

            $user = Auth::guard('admin')->user();


            return view('admin.pages.index', [
                'name' => $user->name,
                'email' => $user->email,
            ], compact('token'));
        }

        // Redirect to login if not authenticated
        return redirect()->route('login');
    }

    public function showLoginForm()
    {

        if (Auth::guard('admin')->check()) {

            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}