@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Modifica evento</h2>
    <form action="{{ route('admin.update', $evento->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <input type="text" name="titolo" value="{{ $evento->titolo }}" class="w-full border rounded p-2" required>
        <textarea name="descrizione" class="w-full border rounded p-2" required>{{ $evento->descrizione }}</textarea>
        <input type="date" name="data" value="{{ $evento->data }}" class="w-full border rounded p-2" required>
        <input type="time" name="orario" value="{{ $evento->orario }}" class="w-full border rounded p-2" required>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">Salva modifiche</button>
    </form>
</div>
@endsection