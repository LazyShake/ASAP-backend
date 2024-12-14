<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_article'); // Primary key
            $table->string('name_article'); // Название статьи
            $table->text('text')->nullable(); // Текст статьи
            $table->string('picture')->nullable(); // Изображение
            $table->unsignedBigInteger('type')->nullable(); // Связь с типами
            $table->timestamps();

            // Внешний ключ
            $table->foreign('type')->references('id_type')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};