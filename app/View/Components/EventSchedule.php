<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Session;

class EventSchedule extends Component
{
    public $departments;

    public function __construct()
    {
        // Fetch sessions grouped by department
        $this->departments = Session::orderBy('date', 'asc')
            ->get()
            ->groupBy('department');
    }

    public function render()
    {
        return view('components.event-schedule', [
            'departments' => $this->departments,
        ]);
    }
}