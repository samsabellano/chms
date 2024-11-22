<?php

namespace Database\Seeders;

use App\Models\Workplace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workplaces = [
            [
                'name' => 'GMall of Davao',
                'address' => 'J.P. Laurel Avenue, Bajada, Davao City, Philippines',
            ],
            [
                'name' => 'Ma-a National Highschool',
                'address' => 'Ma-a, Davao City, Philippines',
            ],
            [
                'name' => 'Southern Philippines Medical Center (SPMC)',
                'address' => 'J.P. Laurel Ave, Bajada, Davao City, 8000 Davao del Sur',
            ]
        ];

        foreach ($workplaces as $workplace) {
            Workplace::create([
                'name' => $workplace['name'],
                'address' => $workplace['address'],
            ]);
        }
    }
}
