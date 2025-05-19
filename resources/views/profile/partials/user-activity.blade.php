<div class="mb-6">
    <h3 class="text-lg font-bold mb-2">Ultimi biglietti acquistati</h3>
    <ul class="list-disc list-inside text-gray-700">
        @forelse($recentTickets as $ticket)
            <li>
                <span class="font-semibold">{{ $ticket->evento->titolo ?? '-' }}</span> -
                {{ $ticket->evento->data ?? '' }}
                ({{ $ticket->evento && $ticket->evento->data ? \Carbon\Carbon::parse($ticket->evento->data)->format('d/m/Y') : '-' }})
            </li>
        @empty
            <li>Nessuna attività recente.</li>
        @endforelse
    </ul>
</div>
