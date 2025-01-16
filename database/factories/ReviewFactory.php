<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'text' => $this->faker->sentence(),
            'picture' => $this->faker->imageUrl(640, 480, 'reviews'),
            'video' => $this->faker->imageUrl(640, 480, 'videos'),
            'profession_id' => Profession::factory(), // Связанная профессия
            'owner' => $this->faker->name(),
            'status' => $this->faker->boolean(),
            'place_job' => $this->faker->company(),
            'job_before' => $this->faker->jobTitle(),
            'job_after' => $this->faker->jobTitle(),
        ];
    }
}
