<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'name_article' => $this->faker->sentence(),
            'short_text' => $this->faker->text(150),
            'content' => $this->faker->paragraphs(3, true),
            'picture' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'type_id' => $this->faker->numberBetween(1, 5), // Укажите диапазон существующих типов
            'id_profession' => $this->faker->numberBetween(1, 5), // Укажите диапазон существующих профессий
            'link' => $this->faker->url(),
            'owner_name' => $this->faker->name(),
            'owner_description' => $this->faker->sentence(),
            'owner_picture' => $this->faker->imageUrl(100, 100, 'people', true, 'Owner'),
            'filter_id' => $this->faker->numberBetween(1, 5), // Укажите диапазон существующих фильтров
        ];
    }
}
