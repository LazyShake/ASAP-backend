<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateIdArticleNullableInTags extends Migration
{
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id_article')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id_article')->nullable(false)->change();
        });
    }
}
