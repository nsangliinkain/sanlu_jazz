<!-- Form di login modificato per migliorare la validazione (resources/views/auth/login.blade.php) -->

@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:underline">
                                Password dimenticata?
                            </a>
                        @endif
                    </div>
                    <input type="password" name="password" id="password" class="w-full p-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded" required>
                    @error('password')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ricordami</label>
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded transition duration-200">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4">
            <p>Non hai un account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Registrati</a></p>
        </div>
    </div>
@endsection