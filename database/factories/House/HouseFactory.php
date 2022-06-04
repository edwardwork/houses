<?php

namespace Database\Factories\House;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fias_code' => $this->faker->text(15),
        ];
    }
}
