<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votante extends Model
{
    //realcion uno a muchos con la tabla Padron
    public function padron()
    {
        return $this->belongsTo(Padron::class);
    }
    use HasFactory;
}
