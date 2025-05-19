@extends('layouts.app')

@section('title', 'Profilo')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-10">

            <!-- Cambia password -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-8">
                <h3 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m0 4a2 2 0 002-2v-2a2 2 0 00-2-2 2 2 0 00-2 2v2a2 2 0 002 2zm6-6V7a6 6 0 10-12 0v6a2 2 0 00-2 2v2a2 2 0 002 2h12a2 2 0 002-2v-2a2 2 0 00-2-2z"/></svg>
                    Cambia password
                </h3>
                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password attuale</label>
                        <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nuova password</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Conferma nuova password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none" required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg transition duration-200 shadow">
                        Aggiorna password
                    </button>
                </form>
            </div>

            <!-- Cancella account -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-8">
                <h3 class="text-2xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                    Elimina account
                </h3>
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Sei sicuro di voler eliminare il tuo account? Questa azione è irreversibile.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition duration-200 shadow">
                        Elimina account
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection