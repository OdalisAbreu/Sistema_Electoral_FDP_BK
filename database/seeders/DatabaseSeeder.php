<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rol = new RolesSeeder();
        $distritos = new DistritosSeeder();
        $municipios = new MunicipiosSeeder();
        $votantes = new VotantesSeeder();


        $rol->run();
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Coordinador',
            'email' => 'coordinador@localhost',
            'role_id' => 2,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $municipios->run();
        $distritos->run();
        $votantes->run();
    }
}
