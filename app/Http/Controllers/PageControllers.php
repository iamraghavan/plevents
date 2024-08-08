<?php

namespace App\Http\Controllers;

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
}