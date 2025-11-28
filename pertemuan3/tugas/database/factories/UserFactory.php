<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menggunakan data statis yang diulang
        $index = $this->faker->unique()->numberBetween(1, 4);
        
        return [
            'name' => 'Faker User ' . $index,
            'username' => 'faker_user_' . $index,
            'email' => 'faker' . $index . '@mail.com',
            'password' => Hash::make('password'),
        ];
    }
}