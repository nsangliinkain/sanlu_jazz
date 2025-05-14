<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $eventi = Event::with(['artisti', 'venue', 'genres', 'tickets'])
            ->where('data', '>=', Carbon::today())
            ->orderBy('data', 'asc')
            ->get();

        return view('admin', compact('eventi'));
    }
}
