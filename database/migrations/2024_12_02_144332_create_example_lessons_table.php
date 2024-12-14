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
        Schema::create('example_lessons', function (Blueprint $table) {
            $table->id('id_example_lesson'); // Primary key
            $table->string('name_example_lesson'); // Название урока
            $table->string('link')->nullable(); // Ссылка на урок
            $table->unsignedBigInteger('id_profession'); // Связь с профессией
            $table->timestamps();

            // Внешний ключ
            $table->foreign('id_profession')->references('id_profession')->on('professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('example_lessons');
    }
};