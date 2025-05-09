<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'mittente_id', 'destinatario_id', 'contenuto'
    ];

    public function mittente() {
        return $this->belongsTo(User::class, 'mittente_id');
    }

    public function destinatario() {
        return $this->belongsTo(User::class, 'destinatario_id');
    }
}
