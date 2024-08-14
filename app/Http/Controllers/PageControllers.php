<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\SlugHelper;

class PageControllers extends Controller
{
    public function home()
    {
        $partners = [
            ['name' => 'Partner 1', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp'],
            ['name' => 'Partner 2', 'image' => 'https://production.egspec.org/assets/images/Accredited/award5.webp'],
            ['name' => 'Partner 3', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp'],
            ['name' => 'Partner 4', 'image' => 'https://production.egspec.org/assets/images/Accredited/award5.webp'],
            ['name' => 'Partner 5', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp']
        ];

        return view('pages.home', compact('partners'));
    }

    public function EventSession(Request $request)
    {
        $query = Session::query();

        // Filter by venue
        if ($request->has('venue') && $request->venue) {
            $query->where('venue', $request->venue);
        }

        // Filter by department
        if ($request->has('department') && $request->department) {
            $query->where('department', $request->department);
        }

        // Filter by mode
        if ($request->has('mode') && $request->mode) {
            $query->where('mode', $request->mode);
        }

        // Filter by price type
        if ($request->has('price_type') && $request->price_type) {
            $query->where('price_type', $request->price_type);
        }

        // Paginate results
        $events = $query->paginate(9); // Adjust the number per page as needed

        // Get distinct filter options
        $venues = Session::select('venue')->distinct()->pluck('venue');
        $departments = Session::select('department')->distinct()->pluck('department');

        // Return the view with events and filter options
        return view('pages.get-events', compact('events', 'venues', 'departments'));
    }


    public function ab()
    {

        return view('pages.get-events');
    }

    public function show($countryCode = null, $id)
    {
        // Log the incoming parameters
        Log::info('Fetching event with ID: ' . $id);

        // Check if ID is a valid integer
        if (!is_numeric($id) || intval($id) <= 0) {
            Log::error('Invalid ID provided: ' . $id);
            abort(404, 'Invalid ID provided.');
        }

        // Find the event by ID
        $event = Session::find($id);

        // Log the result of the query
        Log::info('Event found: ' . ($event ? 'Yes' : 'No'));

        // Check if the event exists
        if (!$event) {
            Log::error('Event not found for ID: ' . $id);
            abort(404, 'Sorry, the event could not be found.');
        }

        return view('pages.show-event-details', compact('event'));
    }
}
