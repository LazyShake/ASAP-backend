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
        // Добавляем колонку для связи с таблицей tariffs
        Schema::table('professions', function (Blueprint $table) {
            // Добавляем внешний ключ
            $table->unsignedBigInteger('id_tariff')->nullable();
            $table->foreign('id_tariff')->references('id_tariff')->on('tariffs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Удаляем связь с таблицей tariffs
        Schema::table('professions', function (Blueprint $table) {
            $table->dropForeign(['id_tariff']);
            $table->dropColumn('id_tariff');
        });
    }
};
