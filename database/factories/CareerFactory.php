<?php

namespace Database\Factories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

class CareerFactory extends Factory
{
    protected $model = Career::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
            'price' => $this->faker->randomFloat(2, 30000, 100000), // Генерируем цену в диапазоне
            'vacancy' => $this->faker->word() . ' Specialist', // Название вакансии
            'images_vacancy' => $this->faker->imageUrl(640, 480, 'business', true, 'Career'),
        ];
    }
}
