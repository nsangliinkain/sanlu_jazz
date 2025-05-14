<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    // Ogni biglietto appartiene a un evento
    public function evento() {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
