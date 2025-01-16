<?php

namespace Database\Factories;

use App\Models\Mentor;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorFactory extends Factory
{
    protected $model = Mentor::class;

    public function definition(): array
    {
        return [
            'name_mentors' => $this->faker->name(),
            'picture' => '/images/' . $this->faker->unique()->word() . '.jpg',
            'description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(),
            'id_profession' => Profession::factory(), // Связанная профессия
            'workplace' => $this->faker->company(),
        ];
    }
}
