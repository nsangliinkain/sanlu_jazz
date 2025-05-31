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

<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold">Eventi Futuri</h3>
        <a href="{{ route('artista.create') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">+ Crea nuovo evento</a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($eventi as $evento)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                @php
                    $venduti = \App\Models\Ticket::where('event_id', $evento->id)->count();
                    $postiDisponibili = $evento->posti_disponibili - $venduti;
                @endphp
                <h4 class="text-xl font-bold mb-2">{{ $evento->titolo }}</h4>
                <p class="text-gray-700"><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d M Y') }} alle {{ $evento->orario }}</p>
                <p class="text-gray-700"><strong>Luogo:</strong> {{ $evento->luogo }}</p>
                <p class="text-gray-700"><strong>Prezzo:</strong> €{{ number_format($evento->prezzo, 2, ',', '.') }}</p>
                <p class="text-gray-700"><strong>Posti disponibili:</strong> {{ $postiDisponibili }}</p>
                <p class="text-gray-700"><strong>Stato:</strong> {{ $evento->stato }}</p>

                @if($evento->stato === 'in_attesa')
                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('admin.approva.prezzo.form', $evento->id) }}" 
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block">
                            Approva
                        </a>
                        <form action="{{ route('admin.rifiuta', $evento->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                Rifiuta
                            </button>
                        </form>
                    </div>
                @endif

                <hr class="my-3">

                <p class="font-semibold text-indigo-700">Artista:</p>
                <ul class="list-disc list-inside text-gray-700 mb-2">
                    @if($evento->artista)
                        <li>{{ $evento->artista->nome }}</li>
                    @else
                        <li>Nessun artista associato</li>
                    @endif
                </ul>

                <p class="font-semibold text-indigo-700">Generi:</p>
                <ul class="list-disc list-inside text-gray-700 mb-2">
                    @forelse($evento->genres as $genere)
                        <li>{{ $genere->nome }}</li>
                    @empty
                        <li>Nessun genere associato</li>
                    @endforelse
                </ul>

                <p class="text-gray-700"><strong>Biglietti venduti:</strong> {{ $evento->tickets->count() }}</p>

                {{-- AGGIUNGI QUESTO BLOCCO --}}
                <a href="{{ route('admin.eventi.artisti', $evento->id) }}"
                class="inline-block mt-3 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Assegna artisti
                </a>

                <form action="{{ route('admin.elimina', $evento->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo evento?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded mt-2">
                    Elimina
                </button>
            </form>
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
