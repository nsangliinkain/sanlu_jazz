@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Assegna artista a: <span class="text-gray-800">{{ $evento->titolo }}</span></h2>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.assegna_artisti', $evento->id) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="artista_id" class="block text-sm font-medium text-gray-700 mb-2">Scegli artista:</label>
            <select name="artista_id" id="artista_id" required
                class="block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach($artisti as $artista)
                    <option value="{{ $artista->id }}">{{ $artista->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
            Assegna artista
        </button>
    </form>
</div>
@endsection