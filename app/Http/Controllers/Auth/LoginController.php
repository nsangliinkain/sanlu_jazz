<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostra il modulo di login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Esegui il login
    public function login(Request $request)
    {
        // Log per debugging
        \Log::info('Tentativo di login con email: ' . $request->email);
        
        // Validazione dei dati
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentativo di login
        if (Auth::attempt($credentials)) {
            // Rigenera la sessione per prevenire attacchi di fixation
            $request->session()->regenerate();
            
            $user = Auth::user();
            \Log::info('Login riuscito per l\'utente: ' . $user->email . ' (ID: ' . $user->id . ')');
            
            return redirect()->intended(route('dashboard'))->with('success', 'Login effettuato con successo!');
        }

        \Log::warning('Tentativo di login fallito per email: ' . $request->email);
        
        // Se l'autenticazione fallisce
        return back()
            ->withErrors(['email' => 'Le credenziali inserite non sono corrette.'])
            ->withInput($request->except('password'));
    }

    // Logout
    public function logout(Request $request)
    {
        \Log::info('Logout effettuato per l\'utente: ' . Auth::user()->email);
        
        Auth::logout();
        
        // Invalidate la sessione
        $request->session()->invalidate();
        
        // Rigenera il token CSRF
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Logout effettuato con successo!');
    }
}