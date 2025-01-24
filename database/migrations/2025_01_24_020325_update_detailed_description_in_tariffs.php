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
        Schema::table('tariffs', function (Blueprint $table) {
            // Удаляем колонку, если она существует, и добавляем новую
            if (Schema::hasColumn('tariffs', 'detailed_description')) {
                $table->dropColumn('detailed_description');
            }

            // Добавляем поле detailed_description
            $table->json('detailed_description')->nullable()->after('installment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tariffs', function (Blueprint $table) {
            // Если нужно вернуть назад, добавляем колонку обратно как string
            $table->string('detailed_description')->nullable()->after('installment');
        });
    }
};