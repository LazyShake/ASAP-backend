<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProfessionIdFromSkillsTable extends Migration
{
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('profession_id');
        });
    }

    public function down()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('profession_id')->nullable()->constrained('professions')->onDelete('cascade');
        });
    }
}
