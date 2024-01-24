<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Votante>
 */
class VotanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'padron_id' => $this->faker->unique()->numberBetween(1, 50),
            'user_id' => $this->faker->numberBetween(2, 3)
        ];
    }
}
