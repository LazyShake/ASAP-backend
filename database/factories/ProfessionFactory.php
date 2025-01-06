<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\Profession;
use App\Models\Type;
use App\Models\Color;
use App\Models\TypeProfession;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionFactory extends Factory
{
    protected $model = Profession::class;

    public function definition(): array
    {
        return [
            'name_profession' => $this->faker->jobTitle(),
            'image' => '/images/' . $this->faker->unique()->word() . '.jpg',
            'price' => $this->faker->numberBetween(50000, 150000),
            'period' => $this->faker->randomElement(['3 months', '4 months', '6 months']),
            'start_of_training' => $this->faker->date(),
            'id_career' => Career::factory(), // Связанная карьера
            'place' => $this->faker->randomElement(['Online', 'Hybrid', 'In-Person']),
            'id_type' => TypeProfession::factory(), // Связанный тип
            'id_color' => $this->faker->numberBetween(1, 2), // Связанный цвет
            'description' => $this->faker->paragraph(),
            'miniimage' => '/images/' . $this->faker->unique()->word() . '-mini.jpg',
        ];
    }
}
