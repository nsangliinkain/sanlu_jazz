<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;

class ArtistaEventController extends Controller
{
    public function index()
    {
        $eventi = Event::where('artista_id', auth()->id())->get();
        return view('artista.index', compact('eventi'));
    }

    public function create()
    {
        $venues = Venue::all();
        $generi = \App\Models\Genre::all();
        $artisti = \App\Models\User::where('ruolo', 'artista')->get();
        return view('artista.create', compact('venues', 'generi', 'artisti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'data' => 'required|date',
            'orario' => 'required|date_format:H:i',
            'posti_disponibili' => 'nullable|required_if:venue_id,new|integer|min:50',
            'nome_locale' => 'nullable|required_if:venue_id,new',
            'indirizzo' => 'nullable|required_if:venue_id,new',
            'capienza' => 'nullable|required_if:venue_id,new|integer|min:100',
            'venue_id' => 'required',
            'genere_id' => 'required|integer|exists:genres,id',
        ]);

        // 1. Se venue_id è "new", crea il nuovo venue
        if ($request->venue_id === 'new') {
            $venue = \App\Models\Venue::create([
                'nome_locale' => $request->nome_locale,
                'indirizzo' => $request->indirizzo,
                'capienza' => $request->capienza,
            ]);
            $venue_id = $venue->id;
        } else {
            $venue_id = $request->venue_id;
        }

        // 2. Ottieni il nome del locale
        if ($request->venue_id === 'new') {
            $nome_locale = $request->nome_locale;
            $posti_disponibili = $request->posti_disponibili;
        } else {
            $venue_esistente = \App\Models\Venue::find($request->venue_id);
            $evento_esistente = \App\Models\Event::where('venue_id', $venue_esistente->id);
            $nome_locale = $venue_esistente->nome_locale;
            $posti_disponibili = $evento_esistente->posti_disponibili;
        }

        // 3. Crea l'evento
        $evento = \App\Models\Event::create([
            'titolo' => $request->titolo,
            'descrizione' => $request->descrizione,
            'data' => $request->data,
            'orario' => $request->orario,
            'venue_id' => $venue_id,
            'luogo' => $nome_locale,
            'posti_disponibili' => $posti_disponibili,
            'artista_id' => $request->artista_id ?? auth()->id(),
            'stato' => 'in_attesa',
            'prezzo' => $request->prezzo ?? null,
        ]);

        // 3. IMPORTANTE: Collega l'evento al genere tramite la tabella pivot
        $evento->genres()->attach($request->genere_id);


        if (auth()->user()->ruolo === 'admin') {
            return redirect()->route('dashboard.admin')->with('success', 'Evento creato con successo!');
        }
        return redirect()->route('dashboard.artista')->with('success', 'Evento creato con successo!');
    }

    public function richiesteEventi()
    {
        $eventi = Event::where('stato', 'in_attesa')->get();
        return view('admin.richieste', compact('eventi'));
    }

    public function approvaEvento($eventoId)
    {
        $evento = Event::findOrFail($eventoId);
        $evento->stato = 'approvato';
        $evento->save();
        return back()->with('success', 'Evento approvato!');
    }

    public function rifiutaEvento($eventoId)
    {
        $evento = Event::findOrFail($eventoId);
        $evento->stato = 'rifiutato';
        $evento->save();
        return back()->with('success', 'Evento rifiutato!');
    }
}
