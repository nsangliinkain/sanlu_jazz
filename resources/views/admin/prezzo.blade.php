@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Approva evento: {{ $evento->titolo }}</h2>
    
    <form action="{{ route('admin.approva', $evento->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="prezzo" class="block font-semibold mb-2">Prezzo (€)</label>
            <input type="number" name="prezzo" id="prezzo" required min="1" step="0.01"
                   class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Conferma approvazione
        </button>
    </form>
</div>
@endsection
