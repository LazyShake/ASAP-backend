<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailedDescriptionToTariffs extends Migration
{
    public function up()
    {
        Schema::table('tariffs', function (Blueprint $table) {
            $table->json('detailed_description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tariffs', function (Blueprint $table) {
            $table->dropColumn('detailed_description');
        });
    }
}