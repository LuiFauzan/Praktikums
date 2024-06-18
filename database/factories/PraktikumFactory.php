<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Praktikum>
 */
class PraktikumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(), // Generate random ASCII string
            'slug' => fake()->word(), // Shuffle the 'nama' string to create a slug
            'semester' => '4',
            'tahunajaran' => '2023-2024 Genap',
        ];
    }
}
