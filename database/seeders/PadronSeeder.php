<?php

namespace Database\Seeders;

use App\Models\Padron;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PadronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Padron::factory()->count(50)->create();
    }
}
