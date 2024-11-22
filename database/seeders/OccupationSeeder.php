<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = [
            'Pastor',
            'Accountant',
            'Architect',
            'Attorney',
            'Business Owner',
            'Doctor',
            'Engineer',
            'Nurse',
            'Teacher',
            'IT Professional',
            'Student'
        ];

        foreach ($occupations as $occupation) {
            Occupation::create(['name' => $occupation]);
        }
    }
}
