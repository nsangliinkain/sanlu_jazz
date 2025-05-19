@extends('layouts.app')

@section('content')
    <h2>Assegna artisti a: {{ $evento->titolo }}</h2>
    <form method="POST" action="{{ route('admin.eventi.artisti.assegna', $evento->id) }}">
        @csrf
        <select name="artisti[]" multiple class="w-full border rounded">
            @foreach($artisti as $artista)
                <option value="{{ $artista->id }}" {{ $evento->artisti->contains($artista->id) ? 'selected' : '' }}>
                    {{ $artista->nome }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">Salva</button>
    </form>
@endsection