<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padron extends Model
{
    protected $table = 'padron';
    protected $fillable = [
        'name',
        'lastname',
        'card_id',
        'mesa',
        'indice',
        'concurrencia',
        'fp',
        'phone',
        'municipio_id',
        'distrito_id',
        'voto',
        'image',
        'apodo',
    ];
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
