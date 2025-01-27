<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionSkillTable extends Migration
{
    public function up()
    {
        Schema::create('profession_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_profession')->constrained('professions')->onDelete('cascade');
            $table->foreignId('id_skills')->constrained('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profession_skill');
    }
}
