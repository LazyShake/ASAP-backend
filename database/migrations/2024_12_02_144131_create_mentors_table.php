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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id('id_mentors'); // Primary key
            $table->string('name_mentors'); // Имя наставника
            $table->string('picture')->nullable(); // Ссылка на фото
            $table->text('description')->nullable(); // Описание наставника
            $table->unsignedBigInteger('id_profession')->nullable(); // Связь с профессией
            $table->string('role')->nullable(); // Роль наставника
            $table->timestamps();

            // Внешний ключ
            $table->foreign('id_profession')->references('id_profession')->on('professions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};