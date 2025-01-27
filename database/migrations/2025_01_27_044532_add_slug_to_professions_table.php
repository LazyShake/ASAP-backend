<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Profession;

class AddSlugToProfessionsTable extends Migration
{
    public function up()
    {
        // 1. Добавляем колонку `slug` с NULL временно
        Schema::table('professions', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        // 2. Генерируем слаги для существующих записей
        foreach (Profession::all() as $profession) {
            $profession->update([
                'slug' => Str::slug($profession->name_profession),
            ]);
        }

        // 3. Делаем колонку `slug` NOT NULL
        Schema::table('professions', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('professions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
