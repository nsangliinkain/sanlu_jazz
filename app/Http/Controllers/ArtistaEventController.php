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
        return view('artista.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'data' => 'required|date',
            'orario' => 'required|date_format:H:i',
            'posti_disponibili' => 'nullable|required_if:venue_id,new|integer|min:50',
            'image_url' => 'required|string',
            'nome_locale' => 'nullable|required_if:venue_id,new',
            'indirizzo' => 'nullable|required_if:venue_id,new',
            'capienza' => 'nullable|required_if:venue_id,new|integer|min:100',
            'venue_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !\App\Models\Venue::where('id', $value)->exists()) {
                        $fail('La venue selezionata non esiste.');
                    }
                },
            ],
        ]);

        if ($request->venue_id === 'new') {
            $venue = Venue::create([
                'nome_locale' => $request->nome_locale,
                'indirizzo' => $request->indirizzo,
                'capienza' => $request->capienza,
            ]);
            $venue_id = $venue->id;
        } else {
            $venue_id = $request->venue_id;
        }

        $postiDisponibili = $request->posti_disponibili;
        if ($request->venue_id !== 'new') {
            $postiDisponibili = Venue::find($request->venue_id)->capienza;
        }

        Event::create([
            'artista_id' => auth()->id(),
            'titolo' => $request->titolo,
            'descrizione' => $request->descrizione,
            'data' => $request->data,
            'orario' => $request->orario,
            'luogo' => Venue::find($venue_id)->nome_locale,
            'prezzo' => null,
            'posti_disponibili' => $postiDisponibili,
            'stato' => 'in_attesa',
            'venue_id' => $venue_id,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('dashboard.artista')->with('success', 'Evento creato e in attesa di approvazione!');
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
