<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Добавление нового столбца.
     */
    public function up(): void
    {
        Schema::table('professions', function (Blueprint $table) {
            $table->text('skilltext')->nullable()->after('name'); // Укажите, после какого столбца добавить поле
        });
    }

    /**
     * Откат миграции.
     */
    public function down(): void
    {
        Schema::table('professions', function (Blueprint $table) {
            $table->dropColumn('skilltext');
        });
    }
};
