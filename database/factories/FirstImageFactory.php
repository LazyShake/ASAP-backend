<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FirstImageFactory extends Factory
{
    protected $model = \App\Models\FirstImage::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(640, 480, 'nature', true, 'Image'),
        ];
    }
}
