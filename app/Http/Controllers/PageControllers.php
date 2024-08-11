<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

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
}
