<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeIdProfessionNullableInArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Делаем поле 'id_profession' необязательным
            $table->unsignedBigInteger('id_profession')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Возвращаем поле обратно как обязательное
            $table->unsignedBigInteger('id_profession')->nullable(false)->change();
        });
    }
}
