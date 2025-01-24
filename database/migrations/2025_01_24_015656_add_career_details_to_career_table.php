<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('career', function (Blueprint $table) {
            $table->integer('vacancies_hh')->after('images_vacancy'); // Количество вакансий по hh.ru
            $table->integer('vacancies_habr')->after('vacancies_hh'); // Количество вакансий по Habr
            $table->integer('freelance_orders')->after('vacancies_habr'); // Количество заказов на фрилансе
            $table->integer('start_salary')->after('freelance_orders'); // Зарплата на старте
            $table->integer('salary_after_1_year')->after('start_salary'); // Зарплата после 1 года работы
            $table->integer('salary_after_3_years')->after('salary_after_1_year'); // Зарплата после 3 лет работы
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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
};
