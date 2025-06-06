@extends('layouts.app')

@section('title', "Dashboard Artista - Sanlu's Jazz")

@section('content')
<section class="relative text-white py-20 px-6 text-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1600&q=80');">
    <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
    <div class="relative z-10">
        <h2 class="text-4xl font-bold mb-4">Benvenuto, {{ Auth::user()->nome }}</h2>
        <p class="text-lg mb-6">Gestisci i tuoi eventi, controlla le vendite e ricevi notifiche.</p>
    </div>
</section>

<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold">🎷 I tuoi eventi</h3>
        <a href="{{ route('artista.create') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">+ Crea nuovo evento</a>
    </div>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-2">Titolo</th>
                    <th class="px-4 py-2">Descrizione</th>
                    <th class="px-4 py-2">Data</th>
                    <th class="px-4 py-2">Orario</th>
                    <th class="px-4 py-2">Luogo</th>
                    <th class="px-4 py-2">Prezzo</th>
                    <th class="px-4 py-2">Capienza</th>
                    <th class="px-4 py-2">Stato</th>
                    <th class="px-4 py-2">Biglietti venduti</th>
                    <th class="px-4 py-2">Incasso (€)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php $eventi = $eventi ?? collect(); @endphp
                @if($eventi && count($eventi))
                    @foreach($eventi as $e)
                        <tr class="hover:bg-indigo-50">
                            <td class="px-4 py-2 font-semibold">{{ $e->titolo }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ Str::limit($e->descrizione, 40) }}</td>
                            <td class="px-4 py-2">{{ $e->data }}</td>
                            <td class="px-4 py-2">{{ $e->orario }}</td>
                            <td class="px-4 py-2">{{ $e->luogo }}</td>
                            <td class="px-4 py-2">€{{ number_format($e->prezzo, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $e->capienza }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs {{ $e->stato === 'approvato' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ ucfirst($e->stato) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $e->tickets->count() ?? 0 }}</td>
                            <td class="px-4 py-2">€{{ number_format($e->tickets->sum('prezzo') ?? 0, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="11" class="text-center py-6 text-gray-500">Nessun evento trovato.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection
