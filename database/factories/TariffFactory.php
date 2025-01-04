<?php

namespace Database\Factories;

use App\Models\Tariff;
use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    protected $model = Tariff::class;

    public function definition(): array
    {
        return [
            'name_tariff' => $this->faker->word(),
            'short_description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'installment' => $this->faker->randomElement(['Yes', 'No']),
            'detailed_description' => $this->faker->paragraph(),
        ];
    }
}
