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
            $table->id('id_tariff');
            $table->string('name_tariff');
            $table->string('short_description');
            $table->decimal('price', 10, 2);
            $table->string('installment');
            $table->text('detailed_description');
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