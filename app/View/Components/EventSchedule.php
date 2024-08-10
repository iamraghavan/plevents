<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Session;

class EventSchedule extends Component
{
    public $events;

    public function __construct()
    {
        // Fetch the three most recent sessions from the database
        $this->events = Session::orderBy('date', 'desc')->take(3)->get();
    }

    public function render()
    {
        return view('components.event-schedule', [
            'events' => $this->events,
        ]);
    }
}