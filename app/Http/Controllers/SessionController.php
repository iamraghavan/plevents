<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{

    public function index(Request $request, $token)
    {
        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        if ($sessionToken !== $token) {

            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        if (Auth::guard('admin')->check()) {

            $sessions = Session::all();
            return view('admin.pages.sessions.index', compact('sessions', 'token'));
        }


        return redirect()->route('login');
    }


    public function create(Request $request, $token)
    {
        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        if ($sessionToken !== $token) {

            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        if (Auth::guard('admin')->check()) {
            $session = new Session();
            return view('admin.pages.sessions.create', compact('session', 'token'));
        }

        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Session::create($request->all());
        return redirect()->route('sessions.index', ['token' => $request->session()->get('admin_auth_token')])
            ->with('success', 'Session created successfully.');
    }

    public function show(Session $session, Request $request, $token)
    {

        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        if ($sessionToken !== $token) {

            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        if (Auth::guard('admin')->check()) {

            return view('admin.pages.sessions.show', compact('session', 'token'));
        }

        return redirect()->route('login');
    }

    public function edit(Session $session, Request $request, $token)
    {
        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        if ($sessionToken !== $token) {

            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        if (Auth::guard('admin')->check()) {
            return view('admin.pages.sessions.edit', compact('session', 'token'));
        }

        return redirect()->route('login');
    }

    public function update(Request $request, $session_id)
    {
        // Log the incoming data for debugging
        Log::info('Update Request Data:', $request->all());

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'conducted_by' => 'required|string',
            'start_time' => 'required|date_format:h:i A', // 12-hour format with AM/PM
            'end_time' => 'required|date_format:h:i A|after:start_time', // 12-hour format with AM/PM
            'date' => 'required|date',
            'location' => 'required|string',
            'venue' => 'required|string',
            'department' => 'required|string',
            'mode' => 'required|string',
            'meeting_url' => 'nullable|url',
            'price_type' => 'required|string',
            'amount' => 'nullable|numeric',
        ]);

        // Convert start_time and end_time to 24-hour format before saving
        $request->merge([
            'start_time' => \Carbon\Carbon::createFromFormat('h:i A', $request->input('start_time'))->format('H:i:s'),
            'end_time' => \Carbon\Carbon::createFromFormat('h:i A', $request->input('end_time'))->format('H:i:s'),
        ]);

        // Find the session by ID
        $session = Session::find($session_id);

        // Check if the session was found
        if (!$session) {
            return redirect()->route('sessions.index')
                ->withErrors(['session' => 'Session not found.']);
        }

        // Update the session data
        $session->update($request->all());

        // Redirect back with success message
        return redirect()->route('sessions.index', ['token' => $request->session()->get('admin_auth_token')])
            ->with('success', 'Session updated successfully.');
    }


    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('sessions.index', ['token' => request()->session()->get('admin_auth_token')])
            ->with('success', 'Session deleted successfully.');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'conducted_by' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'mode' => 'required|in:Online,Offline,Hybrid',
            'meeting_url' => 'nullable|url',
            'price_type' => 'required|in:Free,Idle',
            'amount' => 'nullable|numeric|min:0',
        ]);
    }
}
