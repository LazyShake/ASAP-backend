<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVacanciesFieldsToCareerTable extends Migration
{
    public function up()
{
    Schema::table('career', function (Blueprint $table) {
        $table->integer('vacancies_hh')->nullable();
        $table->integer('vacancies_habr')->nullable();
        $table->integer('freelance_orders')->nullable();
        $table->integer('start_salary')->nullable();
        $table->integer('salary_after_1_year')->nullable();
        $table->integer('salary_after_3_years')->nullable();
    });
}

    public function down()
    {
        Schema::table('career', function (Blueprint $table) {
            $table->dropColumn([
                'vacancies_hh',
                'vacancies_habr',
                'freelance_orders',
                'start_salary',
                'salary_after_1_year',
                'salary_after_3_years',
            ]);
        });
    }
}
