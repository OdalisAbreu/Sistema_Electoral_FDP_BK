<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votante extends Model
{
    //realcion uno a muchos con la tabla Padron
    protected $fillable = ['padron_id', 'user_id'];
    public function padron()
    {
        return $this->belongsTo(Padron::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
