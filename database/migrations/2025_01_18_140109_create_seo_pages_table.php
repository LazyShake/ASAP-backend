<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoPagesTable extends Migration
{
    public function up()
    {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id(); // ID страницы SEO
            $table->string('page_name')->unique(); // Имя страницы (например, название профессии, статья и т.д.)
            $table->string('SEO_title')->nullable(); // Заголовок для SEO
            $table->string('SEO_key_words')->nullable(); // Ключевые слова для SEO
            $table->text('SEO_description')->nullable(); // Описание для SEO
            $table->timestamps(); // Временные метки
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_pages');
    }
}
