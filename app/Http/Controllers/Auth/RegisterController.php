<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'ruolo' => 'spettatore',
        ]);

        return redirect()->route('login')->with('success', 'Registrazione completata!');
    }
    public function showArtistRegisterForm()
{
    return view('auth.register_artist');
}

    public function registerArtist(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'ruolo' => 'artista',
        ]);

        return redirect()->route('login')->with('success', 'Registrazione artista completata! Ora puoi accedere.');
    }
}
