<?php
namespace App\Http\Controllers;

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
            'ruolo' => 'required|in:admin,artista,spettatore',
        ]);

        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'ruolo' => $request->ruolo,
        ]);

        return redirect()->route('login')->with('success', 'Registrazione completata!');
    }
}
