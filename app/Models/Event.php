<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Event extends Model
{
    // Relazione artista: ogni evento appartiene a un utente con ruolo 'artista'
    public function artista() {
        return $this->belongsTo(User::class, 'artista_id');
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'event_genre');
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'event_id');
    }

    // Relazione artisti per dashboard admin (molti-a-molti o uno-a-molti, qui dummy per compatibilità)
    public function artisti() {
        return $this->belongsToMany(Artista::class, 'artista_event', 'event_id', 'artista_id');
    }

}
