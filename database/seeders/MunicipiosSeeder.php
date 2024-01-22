<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear dos Minicipios
        Municipio::create([
            'name' => 'LOS ALCARRIZOS',
        ]);

        Municipio::create([
            'name' => 'PEDRO BRAND',
        ]);
    }
}
