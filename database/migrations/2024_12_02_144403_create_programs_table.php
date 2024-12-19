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
            $table->id('id_program');
            $table->string('name_module');
            $table->string('type_program');
            $table->text('content_module');
            $table->integer('number_module');

            $table->unsignedBigInteger('id_profession');
            $table->foreign('id_profession')->references('id_profession')->on('professions')->onDelete('cascade');
            $table->timestamps();
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