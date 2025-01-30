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
        Schema::table('career', function (Blueprint $table) {
            $table->renameColumn('images_vacancy', 'font');
            $table->text('hh')->nullable();
            $table->text('habr')->nullable();
            $table->text('freelance')->nullable();
            $table->decimal('start_vage', 10, 2)->nullable();
            $table->decimal('one_year_vage', 10, 2)->nullable();
            $table->decimal('three_year_vage', 10, 2)->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career', function (Blueprint $table) {
            $table->renameColumn('font', 'images_vacancy');
            $table->dropColumn(['hh', 'habr', 'freelance', 'start_vage', 'one_year_vage', 'three_year_vage', 'description']);
        });
    }
};
