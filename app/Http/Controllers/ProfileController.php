<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        // Ultimi 5 biglietti acquistati (cronologia attività)
        $recentTickets = \App\Models\Ticket::where('user_id', $user->id)
            ->with('evento')
            ->get();
        return view('profile.edit', compact('user', 'recentTickets'));
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Profilo eliminato con successo.');
    }
}
