<?php

namespace Database\Factories;

use App\Models\Biomarker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Measurement>
 */
class MeasurementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'biomarker_id' => Biomarker::factory(),
            'value' => fake()->randomFloat(1, 1, 120),
            'measured_at' => fake()->dateTimeBetween('-1 year'),
            'note' => fake()->optional()->sentence(),
        ];
    }
}
