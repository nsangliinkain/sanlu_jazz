<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Event extends Model
{
    protected $table = 'events';
    public $timestamps = false;
    protected $fillable = [
        'titolo', 
        'descrizione', 
        'data', 
        'orario', 
        'venue_id', 
        'luogo', 
        'posti_disponibili', 
        'artista_id', 
        'stato'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    // Relazione con Artista (one-to-many)
    public function artista()
    {
        return $this->belongsTo(User::class, 'artista_id');
    }

    // Relazione many-to-many con Genre tramite tabella pivot event_genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'event_genre');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'event_id');
    }
}
