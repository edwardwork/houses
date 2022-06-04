<?php

namespace Database\Factories\Overlap;

use Illuminate\Database\Eloquent\Factories\Factory;

class OverlapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(15)
        ];
    }
}
