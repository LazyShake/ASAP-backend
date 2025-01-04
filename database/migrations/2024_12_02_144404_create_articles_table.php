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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_article');
            $table->string('name_article');
            $table->text('short_text');
            $table->longText('content');
            $table->string('picture');
            $table->text('link');
            $table->text('owner_name');
            $table->text('owner_description');
            $table->text('owner_picture');

            $table->unsignedBigInteger('filter_id');
            $table->foreign('filter_id')->references('filter_id')->on('filter')->onDelete('cascade');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id_type')->on('types')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
};