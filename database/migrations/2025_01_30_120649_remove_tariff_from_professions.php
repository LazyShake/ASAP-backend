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
        // Удаление внешнего ключа и поля id_tariff
        Schema::table('professions', function (Blueprint $table) {
            $table->dropForeign(['id_tariff']); // Удаляем внешний ключ
            $table->dropColumn('id_tariff');    // Удаляем поле
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Восстановление связи с тарифами
        Schema::table('professions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tariff')->nullable(); // Добавляем поле обратно
            $table->foreign('id_tariff')->references('id_tariff')->on('tariffs')->onDelete('cascade'); // Восстанавливаем внешний ключ
        });
    }
};
