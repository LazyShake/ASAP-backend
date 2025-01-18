<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToProfessionsTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professions', function (Blueprint $table) {
            // Добавление новых полей для SEO
            $table->string('SEO_key_words')->nullable()->after('name_profession');
            $table->string('SEO_title')->nullable()->after('key_words');
            $table->text('SEO_description')->nullable()->after('title');
        });
    }

    /**
     * Откатите миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professions', function (Blueprint $table) {
            // Удаляем добавленные поля
            $table->dropColumn(['key_words', 'title', 'description']);
        });
    }
}
