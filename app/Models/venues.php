<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    protected $fillable = [
        'nome', 'indirizzo', 'capienza'
    ];

    public function eventi() {
        return $this->hasMany(Event::class);
    }
}
