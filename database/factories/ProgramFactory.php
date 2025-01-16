<?php

namespace Database\Factories;

use App\Models\Program;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    protected $model = Program::class;

    public function definition(): array
    {
        return [
            'name_module' => $this->faker->sentence(),
            'content_module' => $this->faker->paragraph(),
            'number_module' => $this->faker->numberBetween(1, 10),
            'id_profession' => Profession::factory(), // Связанная профессия
        ];
    }
}
