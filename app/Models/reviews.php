<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'valutazione', 'commento'
    ];

    public function utente() {
        return $this->belongsTo(User::class);
    }

    public function evento() {
        return $this->belongsTo(Event::class);
    }
}
