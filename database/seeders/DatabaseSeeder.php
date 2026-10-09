<?php

namespace Database\Seeders;

use App\Models\Biomarker;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin = doctor account (required for evaluation)
        User::factory()->create([
            'name' => 'Dr. Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'is_doctor' => true,
        ]);

        // Real longevity biomarkers with their optimal ranges
        $biomarkers = collect([
            ['Vitamin D', 'ng/ml', 40, 60, 'Important for bones, immune system and mood.'],
            ['HbA1c', '%', 4.8, 5.4, 'Average blood sugar of the last 3 months.'],
            ['hs-CRP', 'mg/l', 0, 1, 'Marker for silent inflammation in the body.'],
            ['LDL Cholesterol', 'mg/dl', 50, 100, 'The cholesterol that can build up in the arteries.'],
            ['Ferritin', 'ng/ml', 50, 150, 'Shows how much iron is stored in the body.'],
            ['Omega-3 Index', '%', 8, 12, 'Share of omega-3 fatty acids in the red blood cells.'],
        ])->map(fn ($b) => Biomarker::factory()->create([
            'name' => $b[0], 'unit' => $b[1], 'optimal_min' => $b[2], 'optimal_max' => $b[3], 'description' => $b[4],
        ]));

        // Patients with measurements for random biomarkers
        User::factory(5)->create()->each(function (User $patient) use ($biomarkers) {
            foreach ($biomarkers->random(4) as $biomarker) {
                // A value somewhere around the optimal range (sometimes too low or too high)
                Measurement::factory()->create([
                    'user_id' => $patient->id,
                    'biomarker_id' => $biomarker->id,
                    'value' => fake()->randomFloat(1, $biomarker->optimal_min * 0.7, $biomarker->optimal_max * 1.3),
                ]);
            }
        });
    }
}
