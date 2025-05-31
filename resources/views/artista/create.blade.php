@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Crea nuovo evento</h2>

    {{-- Mostra errori di validazione --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('artista.store') }}" method="POST" class="space-y-6">
        @csrf
        <input type="text" name="titolo" placeholder="Titolo" class="w-full border rounded p-2" required>
        <textarea name="descrizione" placeholder="Descrizione" class="w-full border rounded p-2" required></textarea>
        <input type="date" name="data" class="w-full border rounded p-2" required>
        <input type="time" name="orario" class="w-full border rounded p-2" required>
        <input type="text" name="image_url" placeholder="Link Immagine" class="w-full border rounded p-2" required>

        <select name="venue_id" id="venue_id" onchange="toggleVenueFields()" class="w-full border rounded p-2" required>
            <option value="">Seleziona venue esistente</option>
            @foreach($venues as $venue)
                <option value="{{ $venue->id }}">{{ $venue->nome_locale }}</option>
            @endforeach
            <option value="new">Altro (nuovo venue)</option>
        </select>

        <div id="newVenueFields" style="display:none;">
            <input type="text" name="nome_locale" placeholder="Nome venue" class="w-full border rounded p-2 mt-2">
            <input type="text" name="indirizzo" placeholder="Indirizzo venue" class="w-full border rounded p-2 mt-2">
            <input type="number" name="capienza" placeholder="Capienza venue" class="w-full border rounded p-2 mt-2">
            <input type="number" name="posti_disponibili" placeholder="Posti Disponibili" class="w-full border rounded p-2 mt-2">
        </div>

        <input type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition" value="Invia richiesta evento">
    </form>

    <script>
        function toggleVenueFields() {
            const select = document.getElementById('venue_id');
            const newVenueFields = document.getElementById('newVenueFields');
            const inputs = newVenueFields.querySelectorAll('input');

            if (select.value === 'new') {
                newVenueFields.style.display = 'block';
                inputs.forEach(input => input.setAttribute('required', 'required'));
            } else {
                newVenueFields.style.display = 'none';
                inputs.forEach(input => input.removeAttribute('required'));
            }
        }
    </script>
</div>
@endsection
