<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'id_category' => Category::factory(),
            'image' => $this->faker->image("C:\laragon\www\myproject\\takeitnow_lara9\public\assets\img\\event",640,480,null,false),
            'schedule' => $this->faker->dateTimeBetween("now", "+1 months")->format('Y-m-d H:i:s'),
            'price' => ($this->faker->randomNumber(2))*50000,
            'quota' => $this->faker->randomNumber(3),
        ];
    }
}
