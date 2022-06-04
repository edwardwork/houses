<?php

namespace Database\Factories\Gas;

use Illuminate\Database\Eloquent\Factories\Factory;

class GasFactory extends Factory
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
