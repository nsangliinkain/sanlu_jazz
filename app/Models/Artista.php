<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    public function eventi() {
        return $this->belongsToMany(Event::class);
    }

}
