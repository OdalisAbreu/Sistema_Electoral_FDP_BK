<?php

namespace Database\Seeders;

use App\Models\Distrito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Distrito::create([
            'name' => 'LOS ALCARRIZOS',
            'municipio_id' => 1,
        ]);
        Distrito::create([
            'name' => 'PALMAREJO DM',
            'municipio_id' => 1,
        ]);
        Distrito::create([
            'name' => 'PANTOJA DM',
            'municipio_id' => 1,
        ]);
        Distrito::create([
            'name' => 'PEDRO BRAND DM',
            'municipio_id' => 2,
        ]);
        Distrito::create([
            'name' => 'LA CUABA DM',
            'municipio_id' => 2,
        ]);
        Distrito::create([
            'name' => 'LA GUAYIGA DM',
            'municipio_id' => 2,
        ]);
    }
}
