<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venues';

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
