<?php

namespace Database\Factories;

use App\Models\TypeProfession;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeProfessionFactory extends Factory
{
    protected $model = TypeProfession::class;

    public function definition(): array
    {
        return [
            'name_type' => $this->faker->randomElement(['full-time', 'part-time']),
        ];
    }
}
