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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_reviews'); // Primary key
            $table->text('text')->nullable(); // Текст отзыва
            $table->string('picture')->nullable(); // Фото
            $table->string('video')->nullable(); // Видео
            $table->unsignedBigInteger('profession')->nullable(); // Связь с профессией
            $table->string('owner')->nullable(); // Владелец отзыва
            $table->timestamps();

            // Внешний ключ
            $table->foreign('profession')->references('id_profession')->on('professions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};