@extends('layouts.app')

@section('title', 'Statistiche - Sanlu\'s Jazz')

@section('meta')
    <meta name="description" content="Statistiche dettagliate per genere musicale degli eventi di Sanlu's Jazz.">
@endsection

@section('content')
<section class="relative text-white py-16 px-6 text-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x600/?jazz,statistics');">
    <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
    <div class="relative z-10">
        <h2 class="text-3xl font-bold mb-4">Statistiche per Genere</h2>
        <p class="text-lg">Analisi dettagliata delle performance dei generi musicali</p>
    </div>
</section>

<section class="py-12 px-4 max-w-7xl mx-auto">
    <a href="{{ route('dashboard.admin') }}" class="inline-block mb-6 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
        ← Torna alla Dashboard
    </a>
    
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $generiStats = [];
                foreach(\App\Models\Genre::all() as $genere) {
                    $eventiGenere = $genere->events()->get();
                    $totaleEventi = $eventiGenere->count();
                    $totaleBiglietti = 0;
                    $totaleRicavi = 0;
                    
                    foreach($eventiGenere as $evento) {
                        $bigliettiVenduti = \App\Models\Ticket::where('event_id', $evento->id)->count();
                        $totaleBiglietti += $bigliettiVenduti;
                        $totaleRicavi += ($bigliettiVenduti * $evento->prezzo);
                    }
                    
                    $generiStats[] = [
                        'nome' => $genere->nome,
                        'eventi' => $totaleEventi,
                        'biglietti' => $totaleBiglietti,
                        'ricavi' => $totaleRicavi
                    ];
                }
                
                usort($generiStats, function($a, $b) {
                    return $b['eventi'] <=> $a['eventi'];
                });
            @endphp
            
            @forelse($generiStats as $stat)
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-4 rounded-lg border border-indigo-100 hover:shadow-md transition-shadow">
                    <h4 class="font-bold text-lg text-indigo-900 mb-3">{{ $stat['nome'] }}</h4>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Eventi totali:</span>
                            <span class="font-semibold text-indigo-700">{{ $stat['eventi'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Biglietti venduti:</span>
                            <span class="font-semibold text-green-600">{{ $stat['biglietti'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Ricavi totali:</span>
                            <span class="font-semibold text-green-700">€{{ number_format($stat['ricavi'], 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500 py-8">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-lg font-medium">Nessun genere musicale trovato</p>
                    <p class="text-sm">Aggiungi dei generi per visualizzare le statistiche</p>
                </div>
            @endforelse
        </div>
        
        @if(count($generiStats) > 0)
            @php
                $totaleEventiTutti = array_sum(array_column($generiStats, 'eventi'));
                $totaleBigliettiTutti = array_sum(array_column($generiStats, 'biglietti'));
                $totaleRicaviTutti = array_sum(array_column($generiStats, 'ricavi'));
            @endphp
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h4 class="font-bold text-xl mb-6 text-center text-gray-800">Riepilogo Generale</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    <div class="bg-blue-50 p-6 rounded-lg text-center border border-blue-200">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totaleEventiTutti }}</div>
                        <div class="text-sm text-blue-800 font-medium">Eventi Totali</div>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg text-center border border-green-200">
                        <div class="text-3xl font-bold text-green-600 mb-2">{{ $totaleBigliettiTutti }}</div>
                        <div class="text-sm text-green-800 font-medium">Biglietti Venduti</div>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg text-center border border-purple-200">
                        <div class="text-3xl font-bold text-purple-600 mb-2">€{{ number_format($totaleRicaviTutti, 2, ',', '.') }}</div>
                        <div class="text-sm text-purple-800 font-medium">Ricavi Totali</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<footer class="bg-gray-800 text-white text-center py-6 mt-10">
    © 2025 Sanlu's Jazz. Tutti i diritti riservati.
</footer>
@endsection
