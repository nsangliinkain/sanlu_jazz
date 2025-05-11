<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Sanlu’s Jazz - Eventi Musicali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Scopri eventi jazz dal vivo con Sanlu’s Jazz. Concerti, festival e serate indimenticabili.">
    <meta name="keywords" content="jazz, eventi, concerti jazz, musica dal vivo, festival jazz, Sanlu’s Jazz">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <!-- HEADER -->
    <header class="bg-white shadow-md p-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-indigo-600">🎷 Sanlu’s Jazz</h1>
        <nav class="space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline" aria-label="Logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Registrati</a>
            @endauth
        </nav>
    </header>

    <!-- HERO SECTION MIGLIORATA -->
    <section class="relative text-white py-24 px-6 text-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?jazz,stage');">
        <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
        <div class="relative z-10">
            <h2 class="text-4xl font-bold mb-4">Scopri il meglio del Jazz dal vivo 🎶</h2>
            <p class="text-lg mb-6">Partecipa a eventi, segui i tuoi artisti preferiti e vivi esperienze musicali indimenticabili.</p>
            <a href="#eventi" class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-100 transition">
                Esplora gli Eventi
            </a>
        </div>
    </section>

    <!-- SEZIONE CHI SIAMO -->
    <section class="bg-white py-16 px-6 text-center">
        <h3 class="text-2xl font-bold mb-4">🎷 Chi Siamo</h3>
        <p class="text-gray-700 max-w-2xl mx-auto">
            Sanlu’s Jazz è una piattaforma dedicata agli amanti del jazz. Offriamo informazioni su eventi dal vivo, artisti emergenti e festival imperdibili in tutta Italia. Il nostro obiettivo è far vibrare le emozioni attraverso la musica dal vivo.
        </p>
    </section>

    <!-- EVENTI IN EVIDENZA -->
    <section id="eventi" class="py-16 px-6">
        <h3 class="text-2xl font-bold text-center mb-10">🎫 Eventi in Evidenza</h3>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Evento 1 -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/400x250/?jazz,concert" alt="Jazz Night con Luca Bianchi" class="rounded-t-xl w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold">Jazz Night con Luca Bianchi</h4>
                    <p class="text-gray-600 mt-2">Teatro JazzClub - 15 Maggio 2025</p>
                    <p class="text-indigo-600 font-bold mt-2">€20</p>
                </div>
            </div>
            <!-- Evento 2 -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/400x250/?saxophone,music" alt="Sax & Soul Festival" class="rounded-t-xl w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold">Sax & Soul Festival</h4>
                    <p class="text-gray-600 mt-2">Arena Musicale - 21 Maggio 2025</p>
                    <p class="text-indigo-600 font-bold mt-2">€35</p>
                </div>
            </div>
            <!-- Evento 3 -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://source.unsplash.com/400x250/?jazzband,night" alt="Notte Jazz al Porto" class="rounded-t-xl w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold">Notte Jazz al Porto</h4>
                    <p class="text-gray-600 mt-2">Porto Antico - 5 Giugno 2025</p>
                    <p class="text-indigo-600 font-bold mt-2">€25</p>
                </div>
            </div>
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
        © 2025 Sanlu’s Jazz. Tutti i diritti riservati.
    </footer>

</body>
</html>
