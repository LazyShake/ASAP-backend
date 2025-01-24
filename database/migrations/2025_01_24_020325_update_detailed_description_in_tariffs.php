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
            // Изменяем поле detailed_description на JSON, если оно уже существует
            if (Schema::hasColumn('tariffs', 'detailed_description')) {
                $table->json('detailed_description')->nullable()->change();
            } else {
                // Добавляем поле detailed_description, если его нет
                $table->json('detailed_description')->nullable()->after('installment');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tariffs', function (Blueprint $table) {
            // Если нужно вернуть назад, можно изменить поле обратно на string или удалить его
            $table->string('detailed_description')->nullable()->change();
        });
    }
};
