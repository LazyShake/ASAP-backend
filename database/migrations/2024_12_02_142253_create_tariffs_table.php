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
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id('id_tariff'); // Primary key
            $table->string('name_tariff'); // Название тарифа
            $table->string('short_description')->nullable(); // Краткое описание
            $table->string('place')->nullable(); // Место (например, очно/онлайн)
            $table->decimal('price', 10, 2); // Цена
            $table->boolean('installment')->default(false); // Рассрочка
            $table->text('detailed_description')->nullable(); // Подробное описание
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariffs');
    }
};