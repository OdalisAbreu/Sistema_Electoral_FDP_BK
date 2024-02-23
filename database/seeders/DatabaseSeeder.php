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
        // $votantes = new VotantesSeeder();
        // $padron = new PadronSeeder();


        $rol->run();
        \App\Models\User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@localhost',
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // \App\Models\User::factory()->create([
        //     'username' => 'Coordinador',
        //     'email' => 'coordinador@localhost',
        //     'name' => 'Juan',
        //     'last_name' => 'Perez',
        //     'municipio' => '1',
        //     'distrito' => '1',
        //     'role_id' => 2,
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ]);
        // \App\Models\User::factory()->create([
        //     'username' => 'Coordinador2',
        //     'email' => 'coordinador@localhost',
        //     'name' => 'Pedro',
        //     'last_name' => 'Abreu',
        //     'municipio' => '1',
        //     'distrito' => '2',
        //     'role_id' => 2,
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ]);

        $municipios->run();
        $distritos->run();
        // $padron->run();
        // $votantes->run();
    }
}
