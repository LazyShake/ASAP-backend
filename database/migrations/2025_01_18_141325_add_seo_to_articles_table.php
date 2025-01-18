<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoToArticlesTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Добавление SEO данных
            $table->string('seo_title')->nullable()->after('title'); // SEO заголовок
            $table->text('seo_description')->nullable()->after('seo_title'); // SEO описание
            $table->string('seo_keywords')->nullable()->after('seo_description'); // SEO ключевые слова
        });
    }

    /**
     * Откатите миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Удаление SEO данных
            $table->dropColumn(['seo_title', 'seo_description', 'seo_keywords']);
        });
    }
}
