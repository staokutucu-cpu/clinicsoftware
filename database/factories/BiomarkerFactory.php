<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biomarker>
 */
class BiomarkerFactory extends Factory
{
    public function definition(): array
    {
        $min = fake()->randomFloat(1, 1, 50);

        return [
            'name' => ucfirst(fake()->unique()->word()),
            'unit' => fake()->randomElement(['ng/ml', 'mg/dl', '%', 'µmol/l']),
            'optimal_min' => $min,
            'optimal_max' => $min + fake()->randomFloat(1, 5, 50),
            'description' => fake()->sentence(),
        ];
    }
}
