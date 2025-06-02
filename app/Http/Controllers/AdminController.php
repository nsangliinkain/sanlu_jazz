<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

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

    public function richiesteEventi()
    {
        if (!auth()->check() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        
        $eventi = Event::where('stato', 'in_attesa')->get();
        return view('admin.richieste', compact('eventi'));
    }
    
    public function showAssegnaArtisti($eventoId)
    {
        if (!auth()->check() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        $evento = Event::findOrFail($eventoId);
        $artisti = User::where('ruolo', 'artista')->get();
        return view('admin.assegna_artisti', compact('evento', 'artisti'));
    }

    public function assegnaArtista(Request $request, $eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        $evento = Event::findOrFail($eventoId);
        $evento->artista_id = $request->input('artista_id');
        $evento->save();

        // Redirect back to the event assignment page with a success message
        return redirect()->route('dashboard.admin', $eventoId)
            ->with('success', 'Artista assegnato con successo all\'evento.');
    }

    public function approvaEvento(Request $request, $eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }

        $request->validate([
            'prezzo' => 'required|numeric|min:1',
        ]);

        $evento = Event::findOrFail($eventoId);
        $evento->prezzo = $request->input('prezzo');
        $evento->stato = 'attivo';
        $evento->save();

        return redirect()->route('dashboard.admin')->with('success', 'Evento approvato con successo.');
    }

    public function rifiutaEvento(Request $request, $eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }

        $evento = Event::findOrFail($eventoId);
        $evento->stato = 'rifiutato';
        $evento->save();

        return back()->with('success', 'Evento rifiutato!');
    }

    public function showPrezzoForm($id)
    {
        $evento = Event::findOrFail($id);

        return view('admin.prezzo', compact('evento'));
    }

    public function eliminaEvento($eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        $evento = \App\Models\Event::findOrFail($eventoId);
        // Elimina tutti i ticket associati
        $evento->tickets()->delete();
        $evento->delete();
        return back()->with('success', 'Evento eliminato con successo.');
    }

    public function editEvento($eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        $evento = \App\Models\Event::findOrFail($eventoId);
        return view('admin.edit_evento', compact('evento'));
    }

    public function updateEvento(Request $request, $eventoId)
    {
        if (!auth()->user() || auth()->user()->ruolo !== 'admin') {
            abort(403, 'Accesso negato');
        }
        $evento = \App\Models\Event::findOrFail($eventoId);
        $evento->update($request->validate([
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'data' => 'required|date',
            'orario' => 'required',
            'img' => 'required|string',
        ]));
        return redirect()->route('dashboard.admin')->with('success', 'Evento modificato con successo.');
    }
}