<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketController extends Controller
{
    // Funzione per prenotare un biglietto
    public function store(Request $request, Event $evento)
    {
        // Controllo se ci sono posti disponibili
        if ($evento->posti_disponibili < 1) {
            return back()->with('error', 'I posti per questo evento sono esauriti.');
        }

        // Creazione del biglietto
        $ticket = new Ticket();
        $ticket->user_id = Auth::id();  // id dell'utente loggato
        $ticket->event_id = $evento->id;
        $ticket->codice = strtoupper(Str::random(10)); // codice del biglietto
        $ticket->prezzo = $evento->prezzo;
        $ticket->save();

        // Aggiornamento dei posti disponibili
        $evento->posti_disponibili -= 1;
        $evento->save();

        // Ritorno alla dashboard con un messaggio di successo
        return redirect()->route('dashboard')->with('success', 'Biglietto acquistato con successo!');
    }
}
