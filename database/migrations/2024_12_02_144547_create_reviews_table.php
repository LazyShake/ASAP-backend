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
            $table->id('id_review'); // Первичный ключ
            $table->text('text'); // Текст отзыва
            $table->string('picture')->nullable(); // Изображение (может быть пустым)
            $table->string('video')->nullable(); // Видео (может быть пустым)
            $table->boolean('status');
            $table->text('place_job');
            $table->text('job_before');
            $table->text('job_after');
            
            // Связь с профессией (professions)
            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')->references('id_profession')->on('professions')->onDelete('cascade');
        
            $table->string('owner'); // Владелец отзыва
            $table->timestamps(); // created_at и updated_at
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