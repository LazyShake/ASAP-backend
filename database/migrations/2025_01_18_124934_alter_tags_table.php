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
        Schema::table('tags', function (Blueprint $table) {
            // Удаление внешнего ключа
            $table->dropForeign(['id_article']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id_article');
            $table->foreign('id_article')->references('id_article')->on('articles')->onDelete('cascade');
        });
    }
};
