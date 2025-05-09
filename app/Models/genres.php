<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    protected $fillable = ['nome'];

    public function eventi() {
        return $this->belongsToMany(Event::class, 'event_genre');
    }
}
