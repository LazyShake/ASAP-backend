<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVacanciesFieldsToCareerTable extends Migration
{
    public function up()
    {
        Schema::table('career', function (Blueprint $table) {
            $table->integer('vacancies_hh')->default(0);
            $table->integer('vacancies_habr')->default(0);
            $table->integer('freelance_orders')->default(0);
            $table->integer('start_salary')->default(0);
            $table->integer('salary_after_1_year')->default(0);
            $table->integer('salary_after_3_years')->default(0);
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
