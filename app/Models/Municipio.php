<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //crear realacion con distritos de uno a muchos
    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
    //crear realacion con votantes de uno a muchos
    public function votantes()
    {
        return $this->hasMany(Votante::class);
    }
    use HasFactory;
}
