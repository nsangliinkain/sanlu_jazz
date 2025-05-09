<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'ruolo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function eventiCreati() {
        return $this->hasMany(Event::class, 'artista_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function recensioni() {
        return $this->hasMany(Review::class);
    }

    public function messaggiInviati() {
        return $this->hasMany(Message::class, 'mittente_id');
    }

    public function messaggiRicevuti() {
        return $this->hasMany(Message::class, 'destinatario_id');
    }
}
