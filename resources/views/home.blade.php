<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Sanlu\'s Jazz - Eventi Musicali')

@section('content')
    <!-- HERO SECTION MIGLIORATA -->
    <section class="relative text-white py-24 px-6 text-center bg-cover bg-center">
        <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
        <div class="relative z-10">
            <h2 class="text-4xl font-bold mb-4">Scopri il meglio della musica dal vivo</h2>
            <p class="text-lg mb-6">Partecipa a eventi, segui i tuoi artisti preferiti e vivi esperienze musicali indimenticabili.</p>
            <a href="/eventi" class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-100 transition">
                Esplora gli Eventi
            </a>
        </div>
    </section>

    <!-- SEZIONE CHI SIAMO -->
    <section class="bg-white py-16 px-6 text-center">
        <h3 class="text-2xl font-bold mb-4">🎷 Chi Siamo</h3>
        <p class="text-gray-700 max-w-2xl mx-auto">
            Sanlu's Jazz è una piattaforma dedicata agli amanti del jazz, ma non solo. Offriamo informazioni su eventi dal vivo, artisti emergenti e festival imperdibili in tutta Italia. Il nostro obiettivo è far vibrare le emozioni attraverso la musica dal vivo.
        </p>
    </section>

    <!-- EVENTI IN EVIDENZA -->
    <section id="eventi" class="py-16 px-6">
    <h3 class="text-2xl font-bold text-center mb-10">🎫 Eventi in Evidenza</h3>
    <div class="grid md:grid-cols-3 gap-8">
        @forelse($eventi as $evento)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <div class="p-4">
                    <h4 class="text-xl font-semibold">{{ $evento->titolo }}</h4>
                    <p class="text-gray-600 mt-2">{{ $evento->luogo }} - {{ \Carbon\Carbon::parse($evento->data)->format('d M Y') }}</p>
                    <p class="text-indigo-600 font-bold mt-2">€{{ number_format($evento->prezzo, 2, ',', '.') }}</p>
                    <div class="mt-4">
                        <form action="{{ route('tickets.store', $evento->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition w-full">
                                Prenota Ora
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center col-span-3">Nessun evento disponibile al momento.</p>
        @endforelse
    </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-10">
        © 2025 Sanlu's Jazz. Tutti i diritti riservati.
    </footer>

    @if(session('success') || session('error'))
        <div id="popup-messaggio" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
                <h3 class="text-xl font-bold mb-4">
                    @if(session('success')) Successo @else Errore @endif
                </h3>
                <p class="mb-6 text-gray-700">
                    {{ session('success') ?? session('error') }}
                </p>
                <button onclick="document.getElementById('popup-messaggio').style.display='none'"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    OK
                </button>
            </div>
        </div>
    @endif
@endsection