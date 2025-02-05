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
            // Изменяем тип зарплат с decimal на integer
            $table->integer('start_vage')->nullable()->change();
            $table->integer('one_year_vage')->nullable()->change();
            $table->integer('three_year_vage')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career', function (Blueprint $table) {
            // Возвращаем decimal, если откатываем миграцию
            $table->decimal('start_vage', 10, 2)->nullable()->change();
            $table->decimal('one_year_vage', 10, 2)->nullable()->change();
            $table->decimal('three_year_vage', 10, 2)->nullable()->change();
        });
    }
};
