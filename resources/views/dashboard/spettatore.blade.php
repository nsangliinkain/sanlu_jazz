@extends('layouts.app')

@section('title', 'Profilo Spettatore - Sanlu\'s Jazz')

@section('content')
<section class="relative text-white py-24 px-6 text-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?concert,tickets');">
    <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
    <div class="relative z-10">
        <h2 class="text-4xl font-bold mb-4">Benvenuto, {{ Auth::user()->name }}</h2>
        <p class="text-lg mb-6">Qui puoi visualizzare i tuoi biglietti acquistati.</p>
    </div>
</section>

<section class="py-16 px-6">
    <h3 class="text-2xl font-bold text-center mb-10">🎟️ I tuoi biglietti</h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($biglietti as $ticket)
            <div class="bg-white rounded-xl shadow p-4">
                <h4 class="text-xl font-bold">{{ $ticket->evento->titolo }}</h4>
                <p class="text-gray-700"><strong>Data:</strong> {{ \Carbon\Carbon::parse($ticket->evento->data)->format('d M Y') }}</p>
                <p class="text-gray-700"><strong>Orario:</strong> {{ $ticket->evento->orario }}</p>
                <p class="text-gray-700"><strong>Luogo:</strong> {{ $ticket->evento->luogo }}</p>
                <p class="text-gray-700"><strong>Prezzo:</strong> €{{ number_format($ticket->evento->prezzo, 2, ',', '.') }}</p>
                <p class="text-green-600 mt-2">✅ Acquisto confermato</p>
            </div>
        @empty
            <p class="text-center col-span-3">Non hai ancora acquistato biglietti.</p>
        @endforelse
    </div>
</section>
@endsection
