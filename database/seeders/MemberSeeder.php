<?php

namespace Database\Seeders;

use App\Models\Member;
use Database\Factories\MemberFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::factory()->count(20)->create();
    }
}
