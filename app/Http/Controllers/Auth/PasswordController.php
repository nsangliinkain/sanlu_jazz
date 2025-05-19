<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        // Confronto diretto (dato che la password è salvata in chiaro)
        if ($request->current_password !== $user->password) {
            return back()->withErrors(['current_password' => 'La password attuale non è corretta.']);
        }

        // Nessun Hash::make() — la password sarà salvata in chiaro
        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password aggiornata con successo.');
    }

}
