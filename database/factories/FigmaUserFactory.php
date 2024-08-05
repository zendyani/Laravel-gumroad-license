<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FigmaUser>
 */
class FigmaUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'api_key' => $this->faker->unique()->sha256,
            'figma_id' => $this->faker->unique()->uuid,
            'figma_name' => $this->faker->name,
        ];
    }
}
