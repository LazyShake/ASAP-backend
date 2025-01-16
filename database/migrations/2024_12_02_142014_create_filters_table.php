<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id('filter_id'); // Первичный ключ
            $table->string('name_filter', 255); // Название фильтра
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filters');
    }
}
