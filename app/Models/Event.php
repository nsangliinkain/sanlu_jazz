<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function artisti() {
        return $this->belongsToMany(Artista::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'event_genre');
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

}
