<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;

class UpdateArticleSlugsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все записи из таблицы articles
        Article::all()->each(function ($article) {
            // Генерируем слаг только для записей, у которых он отсутствует
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->name_article);
                $article->save();
            }
        });

        $this->command->info('Слаги для статей успешно обновлены!');
    }
}