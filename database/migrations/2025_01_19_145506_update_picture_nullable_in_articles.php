<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePictureNullableInArticles extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Делаем поле 'picture' необязательным
            $table->string('picture')->nullable()->change();
            
            // Делаем поле 'owner_picture' необязательным
            $table->string('owner_picture')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Возвращаем 'picture' обратно как обязательное
            $table->string('picture')->nullable(false)->change();
            
            // Возвращаем 'owner_picture' обратно как обязательное
            $table->string('owner_picture')->nullable(false)->change();
        });
    }
}
