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
        // 1. Добавляем колонку `slug` с NULL временно
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // 2. Заполняем `slug` для существующих записей
        foreach (Article::all() as $article) {
            $article->update([
                'slug' => Str::slug($article->title),
            ]);
        }

        // 3. Делаем колонку `slug` уникальной и NOT NULL
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
