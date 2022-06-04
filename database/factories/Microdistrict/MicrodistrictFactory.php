<?php

namespace Database\Factories\Microdistrict;

use App\Models\Microdistrict\Microdistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

class MicrodistrictFactory extends Factory
{
    protected $model = Microdistrict::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->text(15)
        ];
    }
}
