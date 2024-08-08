<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SpeakersSection extends Component
{
    public $title;
    public $description;
    public $speakers;
    public $viewAllUrl;

    public function __construct($title, $description, $speakers, $viewAllUrl)
    {
        $this->title = $title;
        $this->description = $description;
        $this->speakers = $speakers;
        $this->viewAllUrl = $viewAllUrl;
    }

    public function render()
    {
        return view('components.speakers-section');
    }
}