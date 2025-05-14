<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);

            if ($user->ruolo === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->ruolo === 'artista') {
                return redirect()->route('dashboard.artista');
            } else {
                return redirect()->route('dashboard.spettatore');
            }
        }

        return back()->withErrors(['email' => 'Credenziali non valide']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
