<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\EventRegistrationMod;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class EventRegistration extends Controller
{
    public function getRegister($id = null, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('google.login');
        }

        $events = Session::all();
        $selectedEvent = $id ? Session::findOrFail($id) : Session::first();

        $sessionToken = $request->query('session_token');
        if ($sessionToken && !hash_equals(csrf_token(), $sessionToken)) {
            abort(403, 'Unauthorized action.');
        }

        $encryptedGoogleUid = null;
        if (Auth::check()) {
            $googleUid = Auth::user()->google_uid;
            $salt = config('app.salt');
            $encryptedGoogleUid = encrypt($googleUid . $salt);
        }

        $currentUrl = url()->current();
        $qrCode = QrCode::size(200)->generate($currentUrl);

        return view('pages.register', compact('events', 'selectedEvent', 'encryptedGoogleUid', 'qrCode'));
    }

    private $razorpayId = 'rzp_test_xBOnn1if1rXI8H';
    private $razorpayKey = 'KcM9f04lMUjaQfZplvN0b4PU';

    public function postRegister(Request $request)
    {

        Log::info('Request Data:', $request->all());

        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'google_uid' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'amount' => 'required|numeric|min:1',
            'payment_id' => 'required|string|max:100',
            'order_id' => 'required|string|max:100',
            'invoice_id' => 'nullable|string|max:100', // Make invoice_id optional
        ]);


        Log::info('Validated Data:', $validatedData);

        // Generate event_registration_id based on the format EGSPEC/event_id/DDMMYYAutoincrement
        $eventDate = date('dmy');
        $lastRegistration = EventRegistrationMod::where('event_id', $validatedData['event_id'])
            ->orderBy('id', 'desc')
            ->first();

        $incrementId = $lastRegistration ? (int)substr($lastRegistration->event_registration_id, -4) + 1 : 1;
        $incrementId = str_pad($incrementId, 4, '0', STR_PAD_LEFT); // Ensure it's always 4 digits

        $eventRegistrationId = "EGSPEC/{$validatedData['event_id']}/{$eventDate}{$incrementId}";

        // Generate secure invoice_id if it's not provided
        $invoiceId = $validatedData['invoice_id'] ?? strtoupper(uniqid('INV-', true));

        // Use 'google_uid' instead of 'user_id'
        $registration = new EventRegistrationMod();
        $registration->event_registration_id = $eventRegistrationId;
        $registration->event_id = $validatedData['event_id'];
        $registration->user_id = $validatedData['google_uid']; // Updated field
        $registration->name = $validatedData['name'];
        $registration->email = $validatedData['email'];
        $registration->phone = $validatedData['phone'];
        $registration->address = $validatedData['address'];
        $registration->country = $validatedData['country'];
        $registration->state = $validatedData['state'];
        $registration->city = $validatedData['city'];
        $registration->pincode = $validatedData['pincode'];
        $registration->amount = $validatedData['amount'];
        $registration->payment_id = $validatedData['payment_id'];
        $registration->order_id = $validatedData['order_id'];
        $registration->invoice_id = $invoiceId;
        $registration->save();

        return response()->json(['success' => true, 'message' => 'Registration successful']);
    }



    public function showDetailss($id)
    {
        $event = Session::findOrFail($id);
        return response()->json($event);
    }

    public function showDetails($id)
    {
        $event = Session::findOrFail($id);
        return view('partials.event-details', compact('event'));
    }
}
