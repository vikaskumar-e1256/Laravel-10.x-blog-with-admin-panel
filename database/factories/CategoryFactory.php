<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence($nbWords = 4, $variableNbWords = true),
            'slug' => fake()->slug(),
            'status' => true,
            'created_at' => fake()->dateTime($max = 'now'),
            'updated_at' => fake()->dateTime($max = 'now'),
        ];
    }
}
