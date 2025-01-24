<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVacanciesFieldsToCareerTable extends Migration
{
    public function up()
    {
        Schema::table('career', function (Blueprint $table) {
            // Делаем столбцы nullable
            $table->integer('vacancies_hh')->nullable()->change();
            $table->integer('vacancies_habr')->nullable()->change();
            $table->integer('freelance_orders')->nullable()->change();
            $table->integer('start_salary')->nullable()->change();
            $table->integer('salary_after_1_year')->nullable()->change();
            $table->integer('salary_after_3_years')->nullable()->change();
        });
    }
    

    public function down()
    {
        Schema::table('career', function (Blueprint $table) {
            // Пример: убираем возможность быть NULL
            $table->integer('vacancies_hh')->nullable(false)->change();
            $table->integer('vacancies_habr')->nullable(false)->change();
            $table->integer('freelance_orders')->nullable(false)->change();
            $table->integer('start_salary')->nullable(false)->change();
            $table->integer('salary_after_1_year')->nullable(false)->change();
            $table->integer('salary_after_3_years')->nullable(false)->change();
        });
    }
    
}
