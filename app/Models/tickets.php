<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'quantita', 'prezzo_totale'
    ];

    public function utente() {
        return $this->belongsTo(User::class);
    }

    public function evento() {
        return $this->belongsTo(Event::class);
    }
}
