<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_genre');
    }
}
