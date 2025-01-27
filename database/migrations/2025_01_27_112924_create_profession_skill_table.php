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
            $table->unsignedBigInteger('id_profession'); // Внешний ключ на professions
            $table->unsignedBigInteger('id_skills'); // Внешний ключ на skills
            $table->foreign('id_profession')->references('id_profession')->on('professions')->onDelete('cascade');
            $table->foreign('id_skills')->references('id_skills')->on('skills')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('profession_skill');
    }
}
