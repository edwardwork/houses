<?php

namespace Database\Factories\WallType;

use Illuminate\Database\Eloquent\Factories\Factory;

class WallTypeFactory extends Factory
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
