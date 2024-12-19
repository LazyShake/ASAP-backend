<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'name_article' => 'The Future of Web Development',
            'text' => 'Web development continues to evolve, with new technologies like React, Angular, and Vue dominating the field.',
            'picture' => '/images/web_development.jpg',
            'type_id' => 1, // Предположим, тип с id_type = 1 уже существует
            'id_profession' => 1, // Предположим, профессия с id_profession = 1 уже существует
        ]);

        Article::create([
            'name_article' => 'Introduction to Data Science',
            'text' => 'Data Science combines multiple fields such as statistics, data analysis, and machine learning to extract valuable insights.',
            'picture' => '/images/data_science.jpg',
            'type_id' => 2, // Предположим, тип с id_type = 2 уже существует
            'id_profession' => 2, // Предположим, профессия с id_profession = 2 уже существует
        ]);

        Article::create([
            'name_article' => 'UI/UX Design Best Practices',
            'text' => 'UI/UX design focuses on optimizing the user experience by making applications more user-friendly and visually appealing.',
            'picture' => '/images/ui_ux_design.jpg',
            'type_id' => 1, 
            'id_profession' => 1, 
        ]);
    }
}