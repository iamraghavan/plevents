<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventRegistration extends Controller
{
    public function getRegister($id = null, Request $request)
    {
        if (!Auth::check()) {
            // Redirect to Google login if not authenticated
            return redirect()->route('google.login');
        }

        // Fetch all events
        $events = Session::all();

        // Find the event by ID, or set it to null
        $selectedEvent = $id ? Session::findOrFail($id) : Session::first();

        // Check for session token if provided
        $sessionToken = $request->query('session_token');
        if ($sessionToken && !hash_equals(csrf_token(), $sessionToken)) {
            abort(403, 'Unauthorized action.');
        }

        // Encrypt Google UID with salt if user is authenticated
        $encryptedGoogleUid = null;
        if (Auth::check()) {
            $googleUid = Auth::user()->google_uid;
            $salt = config('app.salt'); // Ensure you have 'salt' in your .env and config/app.php
            $encryptedGoogleUid = encrypt($googleUid . $salt);
        }

        $currentUrl = url()->current();

        // Generate the QR code
        $qrCode = QrCode::size(200)->generate($currentUrl);


        return view('pages.register', compact('events', 'selectedEvent', 'encryptedGoogleUid', 'qrCode'));
    }


    public function postRegister(Request $request)
    {
        // Validate the request
        $request->validate([
            'event_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:10',
            'amount' => 'required',
        ]);

        dd($request->all());
    }



    public function showDetails($id)
    {
        $event = Session::findOrFail($id);
        return view('partials.event-details', compact('event'));
    }
}