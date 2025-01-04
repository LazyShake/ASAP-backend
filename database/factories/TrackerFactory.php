<?php

namespace Database\Factories;

use App\Models\Tracker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackerFactory extends Factory
{
    protected $model = Tracker::class;

    public function definition(): array
    {
        return [
            'name_tracker' => $this->faker->name(),
            'picture' => $this->faker->imageUrl(400, 400, 'people'),
            'description' => $this->faker->sentence(),
        ];
    }
}
