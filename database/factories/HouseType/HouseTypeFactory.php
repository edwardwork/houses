<?php

namespace Database\Factories\HouseType;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseTypeFactory extends Factory
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
