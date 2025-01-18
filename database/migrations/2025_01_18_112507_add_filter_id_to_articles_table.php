<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilterIdToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('filter_id')->nullable()->after('id');

            // Внешний ключ
            $table->foreign('filter_id')
                ->references('id')
                ->on('filters')
                ->onDelete('set null'); // Если фильтр удалён, связь обнуляется
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
            $table->dropForeign(['filter_id']);
            $table->dropColumn('filter_id');
        });
    }
}
