<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'text' => $this->faker->sentence(),
            'profession_id' => Profession::factory(), // Связанная профессия
        ];
    }
}
