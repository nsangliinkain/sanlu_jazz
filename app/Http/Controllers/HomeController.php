<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index()
    {
        $eventi = Event::where('stato', 'attivo')->take(3)->get();
        return view('home', compact('eventi'));
    }

    public function eventi(Request $request)
    {   
        $generi = Genre::all();

        $query = Event::where('stato', 'attivo');

        if ($request->filled('genere')) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('genres.id', $request->genere);
            });
        }

        $eventi = $query->get();

        return view('eventi', compact('eventi', 'generi'));
    }
}
