<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    //crear relacion con votantes de uno a muchos
    public function votantes()
    {
        return $this->hasMany(Votante::class);
    }
    use HasFactory;
}
