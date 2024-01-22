<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votante extends Model
{
    //crear relacion de uno a muchos con distritos
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    //crear relacion de uno a muchos con municipios
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
    use HasFactory;
}
