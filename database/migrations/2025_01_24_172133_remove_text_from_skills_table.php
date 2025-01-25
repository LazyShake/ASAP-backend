<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Удаление столбца.
     */
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('text');
        });
    }

    /**
     * Откат миграции.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->text('text')->nullable(); // Укажите атрибуты, если нужны.
        });
    }
};
