<?php

namespace Database\Factories;

use App\Models\Tags;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    protected $model = Tags::class;

    public function definition(): array
    {
        return [
            'name_tag' => $this->faker->word(),
            'id_article' => Article::factory(), // Связь с моделью Review
        ];
    }
}
