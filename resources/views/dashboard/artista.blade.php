<h2>I tuoi eventi</h2>
<ul>
    @foreach($eventi as $e)
        <li>{{ $e->titolo }} - {{ $e->data }} - {{ $e->luogo }}</li>
    @endforeach
</ul>
