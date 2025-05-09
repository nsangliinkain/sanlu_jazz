<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'titolo', 'descrizione', 'data', 'orario', 'luogo',
        'prezzo', 'posti_disponibili', 'stato', 'artista_id', 'venue_id'
    ];

    public function artista() {
        return $this->belongsTo(User::class, 'artista_id');
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function generi() {
        return $this->belongsToMany(Genre::class, 'event_genre');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function recensioni() {
        return $this->hasMany(Review::class);
    }
}

