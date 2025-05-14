@extends('layouts.app')

@section('title', 'Dashboard Amministratore - Sanlu\'s Jazz')

@section('meta')
    <meta name="description" content="Pannello di controllo per l'amministrazione degli eventi jazz di Sanlu's Jazz.">
@endsection

@section('content')
<section class="relative text-white py-24 px-6 text-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?jazz,admin');">
    <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
    <div class="relative z-10">
        <h2 class="text-4xl font-bold mb-4">Benvenuto nell'Area Admin</h2>
        <p class="text-lg mb-6">Gestisci tutti gli eventi, artisti, generi e prenotazioni.</p>
    </div>
</section>

<section class="py-16 px-6">
    <h3 class="text-2xl font-bold text-center mb-10">📊 Eventi Futuri</h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($eventi as $evento)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                <h4 class="text-xl font-bold mb-2">{{ $evento->titolo }}</h4>
                <p class="text-gray-700"><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d M Y') }} alle {{ $evento->orario }}</p>
                <p class="text-gray-700"><strong>Luogo:</strong> {{ $evento->luogo }}</p>
                <p class="text-gray-700"><strong>Prezzo:</strong> €{{ number_format($evento->prezzo, 2, ',', '.') }}</p>
                <p class="text-gray-700"><strong>Posti disponibili:</strong> {{ $evento->posti_disponibili }}</p>
                <p class="text-gray-700"><strong>Stato:</strong> {{ $evento->stato }}</p>
                <p class="text-gray-700"><strong>Venue:</strong> {{ $evento->venue->nome ?? 'Non specificata' }}</p>

                <hr class="my-3">

                <p class="font-semibold text-indigo-700">🎤 Artista:</p>
                <ul class="list-disc list-inside text-gray-700 mb-2">
                    @if($evento->artista)
                        <li>{{ $evento->artista->nome }}</li>
                    @else
                        <li>Nessun artista associato</li>
                    @endif
                </ul>

                <p class="font-semibold text-indigo-700">🎼 Generi:</p>
                <ul class="list-disc list-inside text-gray-700 mb-2">
                    @forelse($evento->genres as $genere)
                        <li>{{ $genere->nome }}</li>
                    @empty
                        <li>Nessun genere associato</li>
                    @endforelse
                </ul>

                <p class="text-gray-700"><strong>🎟️ Biglietti venduti:</strong> {{ $evento->tickets->count() }}</p>
            </div>
        @empty
            <p class="text-center col-span-3">Nessun evento futuro trovato.</p>
        @endforelse
    </div>
</section>

<footer class="bg-gray-800 text-white text-center py-6 mt-10">
    © 2025 Sanlu's Jazz. Tutti i diritti riservati.
</footer>
@endsection
