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
            $table->string('image');
            $table->decimal('price', 10, 2);
            $table->string('period');
            $table->date('start_of_training');
        
        
            $table->unsignedBigInteger('id_career');
            $table->foreign('id_career')->references('id_career')->on('career')->onDelete('cascade');

            $table->unsignedBigInteger('id_color');
            $table->foreign('id_color')->references('id_color')->on('color')->onDelete('cascade');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id_type')->on('type_profession')->onDelete('cascade');
            // Остальные поля

            $table->string('place');
            $table->string('description');
            $table->string('miniimage');
        
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