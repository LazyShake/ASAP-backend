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
        Schema::create('professions', function (Blueprint $table) {
            $table->id('id_profession'); // Primary key
            $table->string('name_profession'); // Название профессии
            $table->decimal('price', 10, 2); // Цена (до 10 цифр, 2 после запятой)
            $table->integer('period')->nullable(); // Период (например, в днях)
            $table->date('start_of_training')->nullable(); // Дата начала обучения
            $table->text('program')->nullable(); // Программа курса
            $table->unsignedBigInteger('id_mentors')->nullable(); // Связь с наставниками
            $table->unsignedBigInteger('id_tariff')->nullable(); // Связь с тарифами
            $table->unsignedBigInteger('id_article')->nullable(); // Связь с статьями
            $table->unsignedBigInteger('id_training_plan')->nullable(); // Связь с учебным планом
            $table->unsignedBigInteger('id_example_lesson')->nullable(); // Связь с примером урока
            $table->unsignedBigInteger('id_reviews')->nullable(); // Связь с отзывами
            $table->text('skills')->nullable(); // Навыки
            $table->text('employment')->nullable(); // Трудоустройство
            $table->boolean('installment')->default(false); // Рассрочка
            $table->text('referral')->nullable(); // Реферальная информация
            $table->timestamps();

            // Указание внешних ключей
            $table->foreign('id_tariff')->references('id_tariff')->on('tariffs')->onDelete('set null');
            $table->foreign('id_article')->references('id_article')->on('articles')->onDelete('set null');
            $table->foreign('id_training_plan')->references('id_training_plan')->on('training_plans')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};