<?php

namespace Database\Factories\Electricity;

use Illuminate\Database\Eloquent\Factories\Factory;

class ElectricityFactory extends Factory
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
