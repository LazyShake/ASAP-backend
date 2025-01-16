<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    protected $model = \App\Models\Statistic::class;

    public function definition(): array
    {
        return [
            'name_statistics' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
