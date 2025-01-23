<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTestColumnFromCareerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career', function (Blueprint $table) {
            $table->dropColumn('test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career', function (Blueprint $table) {
            $table->string('test')->nullable(); // Добавьте тип столбца и параметры, если известны
        });
    }
}
