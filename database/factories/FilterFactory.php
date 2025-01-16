<?php

namespace Database\Factories;

use App\Models\Filter;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilterFactory extends Factory
{
    protected $model = Filter::class;

    public function definition(): array
    {
        return [
            'name_filter' => $this->faker->word(), // Генерация случайного названия фильтра
        ];
    }
}
