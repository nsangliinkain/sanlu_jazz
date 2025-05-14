<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->ruolo === 'spettatore') {
            $biglietti = Ticket::where('user_id', auth()->id())->with('evento')->get();
            return view('dashboards.spettatore', compact('biglietti'));

        } elseif ($user->ruolo === 'artista') {
            $eventi = Event::where('artista_id', $user->id)->with('tickets')->get();
            return view('dashboards.artista', compact('eventi'));

        } elseif ($user->ruolo === 'admin') {
            $utenti = User::all();
            $eventi = Event::with(['venue', 'artista'])->get();
            $biglietti = Ticket::all();
            return view('dashboards.admin', compact('utenti', 'eventi', 'biglietti'));
        }

        return abort(403);
    }

}
