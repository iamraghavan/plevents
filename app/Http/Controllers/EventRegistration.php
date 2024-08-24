<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

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


    private $razorpayId;
    private $razorpayKey;

    public function __construct()
    {
        $this->razorpayId = env('RAZORPAY_KEY_ID');
        $this->razorpayKey = env('RAZORPAY_KEY_SECRET');
    }

    public function postRegister(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required',
            'google_uid' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:10',
            'amount' => 'required',
        ]);

        // Check if payment is required
        if ($request->input('amount') > 0 && $request->input('country') === 'India') {
            // Handle payment with Razorpay
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $orderData = [
                'receipt'         => time(),
                'amount'          => $request->input('amount') * 100, // Amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Automatically capture payment
            ];
            $order = $api->order->create($orderData);

            $orderId = $order->id;
            $paymentId = null; // This will be set after payment success
            $invoiceId = 'INV' . $orderId; // Example invoice ID
            $paymentMethod = 'razorpay';
            $transactionDate = null; // To be set on payment success
        } else {
            // Free event or international user
            $orderId = null;
            $paymentId = null;
            $invoiceId = null;
            $paymentMethod = null;
            $transactionDate = null;
        }

        // Create the event registration
        DB::transaction(function () use ($validated, $orderId, $paymentId, $invoiceId, $paymentMethod, $transactionDate) {
            $registrationId = $this->generateRegistrationId($validated['event_id']);

            $registration = EventRegistration::create(array_merge($validated, [
                'registration_id' => $registrationId,
                'amount' => $validated['amount'],
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'invoice_id' => $invoiceId,
                'payment_method' => $paymentMethod,
                'transaction_date' => $transactionDate,
            ]));

            if ($orderId) {
                session(['order_id' => $orderId, 'registration_id' => $registrationId]);
                return redirect()->route('payment.redirect', ['order_id' => $orderId]);
            }
        });

        // Redirect to a success page if no payment is needed
        if ($orderId === null) {
            return redirect()->route('register.success')->with('success', 'Registration successful.');
        }
    }

    public function handlePayment(Request $request)
    {
        $api = new Api($this->razorpayId, $this->razorpayKey);

        $orderId = $request->input('order_id');
        $paymentId = $request->input('razorpay_payment_id');
        $signature = $request->input('razorpay_signature');

        $order = $api->order->fetch($orderId);
        $attributes = [
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            $registrationId = session('registration_id');
            EventRegistration::where('registration_id', $registrationId)->update([
                'payment_id' => $paymentId,
                'transaction_date' => now()
            ]);

            PaymentTransaction::create([
                'event_registration_id' => EventRegistration::where('registration_id', $registrationId)->first()->id,
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'invoice_id' => 'INV' . $orderId,
                'payment_method' => 'razorpay',
                'amount' => request('amount'),
                'transaction_date' => now()
            ]);

            session()->forget(['order_id', 'registration_id']);
            return redirect()->route('register.success')->with('success', 'Registration and payment successful.');
        } catch (\Exception $e) {
            return redirect()->route('payment.failure')->with('error', 'Payment verification failed.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        return view('payment.success');
    }

    public function paymentFailure(Request $request)
    {
        return view('payment.failure');
    }

    private function generateRegistrationId($eventId)
    {
        $dateTime = now()->format('dmyHis');
        $latest = EventRegistration::where('event_id', $eventId)
            ->latest('id')
            ->first();

        $nextNumber = $latest ? $latest->id + 1 : 1;
        $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return "EGSPEC/{$eventId}/{$dateTime}{$formattedNumber}";
    }



    public function showDetails($id)
    {
        $event = Session::findOrFail($id);
        return view('partials.event-details', compact('event'));
    }
}