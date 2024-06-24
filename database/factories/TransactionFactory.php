<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_user' => User::factory(),
            'id_event' => Event::factory(),
            'quantity' => $this->faker->randomNumber(1),
            'proof' => $this->faker->image("C:\laragon\www\myproject\\takeitnow_lara9\public\assets\img\uploads",640,480,null,false),
        ];
    }

    public function valid(): static
    {
        return $this->state(fn (array $attributes) => [
            'isValid' => true,
        ]);
    }

    public function transaction(): static
    {
        return $this->state(fn (array $attributes) => [
            'id_user' => 2,
            'id_event' => Event::factory(),
            'quantity' => $this->faker->randomNumber(1),
            'proof' => "blank.jpg",
        ]);
    }
}
