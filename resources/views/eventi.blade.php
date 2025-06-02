<!-- resources/views/eventi.blade.php -->
@extends('layouts.app')

@section('title', 'Sanlu\'s Jazz - Tutti gli Eventi')


@section('content')
    <!-- HERO SECTION -->
    <section class="relative text-white py-24 px-6 text-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?jazz,concert');">
        <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
        <div class="relative z-10">
            <h2 class="text-4xl font-bold mb-4">I Nostri Eventi 🎷</h2>
            <p class="text-lg mb-6">Scopri tutti gli eventi musicali in programma e prenota il tuo posto subito!</p>
        </div>
    </section>

    <!-- TUTTI GLI EVENTI -->
    <section class="py-16 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <h3 class="text-2xl font-bold text-center md:text-left mb-4 md:mb-0">🎫 Calendario Eventi</h3>
            <!-- Filtro Generi: -->
            <form method="GET" action="{{ route('eventi') }}">
                <div class="relative group">
                    <select name="genere" id="genere"
                        onchange="this.form.submit()"
                        class="appearance-none bg-gradient-to-r from-white to-indigo-50 border-2 border-indigo-200 rounded-xl px-6 py-3 pr-12 shadow-lg focus:ring-4 focus:ring-indigo-200 focus:border-indigo-400 transition-all duration-300 text-gray-700 hover:shadow-xl font-medium min-w-[200px]">
                        <option value="">Tutti i generi</option>
                        @foreach($generi as $genere)
                            <option value="{{ $genere->id }}" {{ request('genere') == $genere->id ? 'selected' : '' }}>
                                {{ $genere->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request('genere'))
                    <div class="mt-2 text-center">
                        <a href="{{ route('eventi') }}" class="text-xs text-indigo-600 hover:text-indigo-800 underline">
                            ✕ Rimuovi filtro
                        </a>
                    </div>
                @endif
            </form>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($eventi as $evento)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <div class="p-4">
                        <h4 class="text-xl font-semibold">{{ $evento->titolo }}</h4>
                        <p class="text-gray-700 mt-2">{{ $evento->descrizione }}</p>
                        <p class="text-gray-600 mt-2">{{ $evento->luogo }} - {{ \Carbon\Carbon::parse($evento->data)->format('d M Y') }}</p>
                        <p class="text-indigo-600 font-bold mt-2">€{{ number_format($evento->prezzo, 2, ',', '.') }}</p>
                        <div class="mt-4">
                            @php
                                $venduti = \App\Models\Ticket::where('event_id', $evento->id)->count();
                                $postiDisponibili = $evento->posti_disponibili - $venduti;
                            @endphp

                            @if ($postiDisponibili > 0)
                                <form action="{{ route('tickets.store', $evento->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition w-full">
                                        Prenota Ora ({{ $postiDisponibili }} disponibili)
                                    </button>
                                </form>
                            @else
                                <p class="text-red-600 font-semibold text-center">Posti esauriti</p>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3">Nessun evento disponibile al momento.</p>
            @endforelse
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="bg-indigo-100 py-12 px-6 text-center">
        <h3 class="text-xl font-bold mb-4">🎵 Resta aggiornato</h3>
        <p class="mb-4">Iscriviti alla nostra newsletter per non perdere nessun evento!</p>
        <form action="#" method="POST" class="flex flex-col md:flex-row justify-center gap-4">
            <input type="email" placeholder="La tua email" aria-label="Inserisci la tua email" class="px-4 py-2 rounded-md border border-gray-300 w-64">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Iscriviti</button>
        </form>
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