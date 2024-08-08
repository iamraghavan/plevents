<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EventSchedule extends Component
{
    public $eventDate;
    public $eventTitle;
    public $registerUrl;

    public function __construct($eventDate, $eventTitle, $registerUrl)
    {
        $this->eventDate = $eventDate;
        $this->eventTitle = $eventTitle;
        $this->registerUrl = $registerUrl;
    }

    public function render()
    {
        return view('components.event-schedule');
    }
}