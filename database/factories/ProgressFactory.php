<?php

namespace Database\Factories;

use App\Models\Progress;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgressFactory extends Factory
{
    protected $model = Progress::class;

    public function definition(): array
    {
        return [
            'before' => $this->faker->imageUrl(640, 480, 'before'),
            'after' => $this->faker->imageUrl(640, 480, 'after'),
            'id_profession' => Profession::factory(), // Связанная профессия
        ];
    }
}
