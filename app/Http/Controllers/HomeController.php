<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $eventi = Event::all();
        return view('home', compact('eventi'));
    }
}
