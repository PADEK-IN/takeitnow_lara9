<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // password
            'email_verified_at' => now(),
            'name' => $this->faker->name(),
            'gender' => "male",
            'phone' => $this->faker->e164PhoneNumber(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function female(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->name("female"),
            'gender' => "female",
        ]);
    }

    public function setAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => "admin",
        ]);
    }
}
