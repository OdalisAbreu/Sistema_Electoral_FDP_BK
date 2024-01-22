<?php

namespace Database\Seeders;

use App\Models\Votante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VotantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear Votantes aleatoreos con los minicipios id 1 y 2 y los distritos id del 1 al 6
        Votante::factory()->count(50)->create();
    }
}
