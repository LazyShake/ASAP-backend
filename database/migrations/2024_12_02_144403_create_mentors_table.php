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
            $table->id('id_mentor');
            $table->string('name_mentors');
            $table->string('picture');
            $table->text('description');
            $table->boolean('status');
            $table->string('workplace');

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
        Schema::dropIfExists('mentors');
    }
};