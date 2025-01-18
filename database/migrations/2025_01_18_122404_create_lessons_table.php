<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('example_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name_example_lesson');
            $table->string('link');
            $table->foreignId('id_profession')->constrained('professions', 'id_profession')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Откатите миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('example_lessons');
    }
}
