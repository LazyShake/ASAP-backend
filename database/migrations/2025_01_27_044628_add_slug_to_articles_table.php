<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Article;

class AddSlugToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Проверяем, есть ли уже колонка `slug`
        if (!Schema::hasColumn('articles', 'slug')) {
            // 1. Добавляем колонку `slug` с NULL временно
            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name_article');
            });

            // 2. Заполняем уникальные значения для `slug`
            foreach (Article::all() as $article) {
                $slug = Str::slug($article->name_article);
                $originalSlug = $slug;
                $counter = 1;

                // Генерируем уникальный `slug`, если он уже существует
                while (Article::where('slug', $slug)->exists()) {
                    $slug = "{$originalSlug}-{$counter}";
                    $counter++;
                }

                $article->update(['slug' => $slug]);
            }

            // 3. Делаем колонку `slug` уникальной и NOT NULL
            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->unique()->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Удаляем колонку `slug`, только если она существует
        if (Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
}
