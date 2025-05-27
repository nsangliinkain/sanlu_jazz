<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Event extends Model
{
    protected $fillable = [
        'titolo',
        'descrizione',
        'data',
        'orario',
        'luogo',
        'artista_id',
        'stato',
        'prezzo',
        'posti_disponibili',
        'img'
    ];
    protected $casts = [
        'data' => 'datetime',
        'orario' => 'datetime:H:i',
    ];
    protected $table = 'events';
    public $timestamps = false;
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
}
