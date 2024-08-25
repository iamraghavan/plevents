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

        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'event_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'payment_id' => 'required|string',
        ]);

        // Initialize Razorpay API with the keys from the .env file
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        // Fetch payment details from Razorpay
        try {
            $payment = $api->payment->fetch($request->input('payment_id'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Payment verification failed. Please try again.');
        }

        // Check if the payment is successful
        if ($payment->status !== 'captured') {
            return redirect()->back()->withErrors('Payment not completed. Please try again.');
        }

        // Store the registration and payment details in the database
        $registration = EventRegistrationMod::create([
            'event_id' => $request->input('event_id'),
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'amount' => $payment->amount / 100, // Convert from paise to INR
            'payment_id' => $payment->id,
            'order_id' => $payment->order_id,
            'invoice_id' => $payment->invoice_id,
        ]);

        // Redirect to a thank you page or any other page
        return view('payment-success')->with('success', 'Registration completed successfully!');
    }



    public function showDetails($id)
    {
        $event = Session::findOrFail($id);
        return view('partials.event-details', compact('event'));
    }
}
