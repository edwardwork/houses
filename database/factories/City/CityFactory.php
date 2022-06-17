<?php

namespace Database\Factories\City;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CityFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(15)
        ];
    }
}
