<?php

namespace Database\Factories\Sewerage;

use Illuminate\Database\Eloquent\Factories\Factory;

class SewerageFactory extends Factory
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
