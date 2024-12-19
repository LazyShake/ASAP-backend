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
            $table->string('name_profession');
            $table->decimal('price', 10, 2);
            $table->string('period');
            $table->date('start_of_training');
        
        
            // Связь с тарифами (tariffs)
            $table->unsignedBigInteger('tariff_id');
            $table->foreign('tariff_id')->references('id_tariff')->on('tariffs')->onDelete('cascade');
        
        
            // Связь с учебным планом (training_plans)
            $table->unsignedBigInteger('training_plan_id');
            $table->foreign('training_plan_id')->references('id_training_plan')->on('training_plans')->onDelete('cascade');
        
            // Связь с примерными уроками (example_lessons)
            $table->unsignedBigInteger('example_lesson_id');
            $table->foreign('example_lesson_id')->references('id_example_lesson')->on('example_lessons')->onDelete('cascade');
        
            $table->unsignedBigInteger('id_career');
            $table->foreign('id_career')->references('id_career')->on('career')->onDelete('cascade');

            $table->unsignedBigInteger('id_color');
            $table->foreign('id_color')->references('id_color')->on('color')->onDelete('cascade');
            // Остальные поля

            $table->string('place');
            $table->string('type');
        
            $table->timestamps(); // created_at и updated_at
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