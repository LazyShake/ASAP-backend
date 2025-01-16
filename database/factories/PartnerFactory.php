<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    protected $model = \App\Models\Partner::class;

    public function definition(): array
    {
        return [
            'name_partners' => $this->faker->company(),
            'logo_partners' => $this->faker->imageUrl(100, 100, 'business', true, 'logo'),
        ];
    }
}
