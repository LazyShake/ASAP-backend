<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    protected $model = Type::class;

    public function definition()
    {
        return [
            'name_type' => $this->faker->word,  // Генерация случайного слова для name_type
        ];
    }
}
