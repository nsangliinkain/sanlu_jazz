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
    public function store($eventoId)
    {
        if (auth()->user()->ruolo === 'admin' || auth()->user()->ruolo === 'artista') {
            return back()->with('error', 'Solo gli spettatori possono acquistare biglietti.');
        }

        $user = auth()->user();
        $evento = Event::findOrFail($eventoId);

        // Controlla se l'utente ha già prenotato questo evento
        $giaprenotato = Ticket::where('user_id', $user->id)
            ->where('event_id', $evento->id)
            ->exists();

        if ($giaprenotato) {
            return back()->with('error', 'Hai già prenotato questo evento.');
        }

        $capienza = $evento->posti_disponibili;
        $venduti = Ticket::where('event_id', $evento->id)->count();

        if ($venduti >= $capienza) {
            return back()->with('error', 'Posti esauriti per questo evento.');
        }

        $numero_posto = $venduti + 1;
        $codice = strtoupper(bin2hex(random_bytes(5)));

        Ticket::create([
            'user_id'      => $user->id,
            'event_id'     => $evento->id,
            'codice'       => $codice,
            'data_acquisto'=> now(),
            'prezzo'       => $evento->prezzo,
            'numero_posto' => $numero_posto,
        ]);

        return back()->with('success', 'Biglietto acquistato con successo! Il tuo posto è il numero ' . $numero_posto);
    }

    public function destroy($id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $ticket->delete(); // Questo elimina davvero il record
        return back()->with('success', 'Biglietto cancellato con successo.');
    }
}
