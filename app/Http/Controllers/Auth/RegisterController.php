<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // Mostra il modulo di registrazione
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Esegui la registrazione
    public function register(Request $request)
    {
        // Log per debugging
        \Log::info('Tentativo di registrazione con i dati:', $request->all());
        
        // Validazione dei dati
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'ruolo' => 'required|in:spettatore,artista,admin',
        ]);

        if ($validator->fails()) {
            \Log::warning('Errori di validazione:', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        // Avvolgiamo la creazione dell'utente in una transazione DB
        try {
            DB::beginTransaction();
            
            // Creazione dell'utente
            $user = User::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ruolo' => $request->ruolo,
            ]);
            
            \Log::info('Utente creato con successo. ID: ' . $user->id);
            
            DB::commit();
            
            // Login automatico dopo la registrazione
            Auth::login($user);
            
            \Log::info('Login automatico effettuato per l\'utente: ' . $user->email);
            
            return redirect()->route('dashboard')->with('success', 'Registrazione completata con successo!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Errore durante la registrazione: ' . $e->getMessage());
            return back()->with('error', 'Si è verificato un errore durante la registrazione. Riprova più tardi.')->withInput();
        }
    }
}