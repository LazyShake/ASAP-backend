<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    protected $model = \App\Models\Test::class;

    public function definition(): array
    {
        return [
            'link' => $this->faker->url(),
        ];
    }
}
