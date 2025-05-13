<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $eventi = Event::take(3)->get();
        return view('home', compact('eventi'));
    }

    public function eventi()
    {   
        $eventi = Event::all();
        return view('eventi', compact('eventi'));
    }
}
