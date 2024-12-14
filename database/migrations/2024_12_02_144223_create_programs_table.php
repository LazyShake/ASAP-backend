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
        Schema::create('programs', function (Blueprint $table) {
            $table->id('id_program'); // Primary key
            $table->string('name_module'); // Название модуля
            $table->string('type_program')->nullable(); // Тип программы
            $table->text('content_module')->nullable(); // Контент модуля
            $table->unsignedBigInteger('id_profession'); // Связь с профессией
            $table->integer('number_module')->nullable(); // Номер модуля
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
        Schema::dropIfExists('programs');
    }
};