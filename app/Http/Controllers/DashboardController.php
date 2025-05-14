<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->ruolo === 'spettatore') {
            $biglietti = Biglietto::where('user_id', $user->id)->get();
            return view('dashboard.spettatore', compact('biglietti'));

        } elseif ($user->ruolo === 'artista') {
            $eventi = Event::where('artista_id', $user->id)->get();
            return view('dashboard.artista', compact('eventi'));

        } elseif ($user->ruolo === 'admin') {
            $utenti = User::all();
            $eventi = Event::all();
            $biglietti = Biglietto::all();
            return view('dashboard.admin', compact('utenti', 'eventi', 'biglietti'));
        }

        return abort(403);
    }

}
