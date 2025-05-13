<!-- Form di registrazione modificato per migliorare la validazione (resources/views/auth/register.blade.php) -->

@extends('layouts.app')

@section('title', 'Registrazione')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-center mb-6">Registrazione</h2>
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="nome" id="nome" class="w-full p-2 border @error('nome') border-red-500 @else border-gray-300 @enderror rounded" value="{{ old('nome') }}" required autofocus>
                    @error('nome')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded" required>
                    <p class="text-xs text-gray-500 mt-1">La password deve contenere almeno 6 caratteri</p>
                    @error('password')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Conferma Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-6">
                    <label for="ruolo" class="block text-sm font-medium text-gray-700">Ruolo</label>
                    <select name="ruolo" id="ruolo" class="w-full p-2 border @error('ruolo') border-red-500 @else border-gray-300 @enderror rounded" required>
                        <option value="">-- Seleziona un ruolo --</option>
                        <option value="spettatore" {{ old('ruolo') == 'spettatore' ? 'selected' : '' }}>Spettatore</option>
                        <option value="artista" {{ old('ruolo') == 'artista' ? 'selected' : '' }}>Artista</option>
                        <option value="admin" {{ old('ruolo') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('ruolo')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded transition duration-200">
                        Registrati
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4">
            <p>Hai già un account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Accedi</a></p>
        </div>
    </div>
@endsection