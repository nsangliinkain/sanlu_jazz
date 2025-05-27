<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $eventi = Event::where('stato', 'attivo')->take(3)->get();
        return view('home', compact('eventi'));
    }

    public function eventi()
    {   
        $eventi = Event::where('stato', 'attivo')->get();
        return view('eventi', compact('eventi'));
    }
}
