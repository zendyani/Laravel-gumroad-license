<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\License\Enum\License as LicenseType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\License>
 */
class LicenseFactory extends Factory
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
            'license' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
            'product_permalink' => $this->faker->url,
            'product_name' => LicenseType::THEME_COMPOSER_BUSINESS->value, // Adjust based on your License enum
            'price' => $this->faker->randomFloat(2, 10, 100),
            'ip_country' => $this->faker->country,
            'recurrence' => $this->faker->word,
            'uses' => $this->faker->numberBetween(1, 10),
            'product_code' => LicenseType::THEME_COMPOSER_BUSINESS->value, // Adjust based on your License enum
            'sale_timestamp' => now(),
        ];
    }
}
