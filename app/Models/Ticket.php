<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    public $timestamps = false;
    protected $fillable = ['user_id', 'event_id', 'codice', 'data_acquisto', 'prezzo', 'numero_posto'];

    // Ogni biglietto appartiene a un evento
    public function evento() {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function utente() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
