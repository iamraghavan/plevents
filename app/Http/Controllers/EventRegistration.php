<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class EventRegistration extends Controller
{
    public function getRegister($id)
    {
        $event = Session::findOrFail($id);
        return view('pages.register', compact('event'));
    }
}