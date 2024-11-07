<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 10),
            'first_name' => fake()->firstName,
            'middle_name' => fake()->lastName,
            'last_name' => fake()->lastName,
            'photo' => fake()->imageUrl,
            'age' => random_int(5, 50),
            'gender' => 'Male',
            'address' => fake()->city
        ];
    }
}
