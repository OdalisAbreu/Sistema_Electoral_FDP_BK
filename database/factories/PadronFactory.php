<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Padron>
 */
class PadronFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'card_id' => $this->faker->unique()->numerify('###########'),
            'municipio_id' => $this->faker->numberBetween(1, 2),
            'distrito_id' => $this->faker->numberBetween(1, 6),
            'mesa' => $this->faker->numberBetween(1000, 2000),
            'indice' => $this->faker->numberBetween(100, 600),
            'image' => $this->faker->imageUrl(640, 480)
        ];
    }
}
