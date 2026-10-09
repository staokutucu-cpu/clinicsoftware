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
            ['Vitamin D', 'ng/ml', 40, 60],
            ['HbA1c', '%', 4.8, 5.4],
            ['hs-CRP', 'mg/l', 0, 1],
            ['LDL Cholesterol', 'mg/dl', 50, 100],
            ['Ferritin', 'ng/ml', 50, 150],
            ['Omega-3 Index', '%', 8, 12],
        ])->map(fn ($b) => Biomarker::factory()->create([
            'name' => $b[0], 'unit' => $b[1], 'optimal_min' => $b[2], 'optimal_max' => $b[3],
        ]));

        // Patients with measurements for random biomarkers
        User::factory(5)->create()->each(function (User $patient) use ($biomarkers) {
            Measurement::factory(4)->create([
                'user_id' => $patient->id,
                'biomarker_id' => fn () => $biomarkers->random()->id,
            ]);
        });
    }
}
