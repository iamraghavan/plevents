<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageBanner extends Component
{
    public $title;
    public $breadcrumbs;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $breadcrumbs)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.page-banner');
    }
}
