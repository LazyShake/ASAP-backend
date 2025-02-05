<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        Statistic::create([
            'quantity' => 16,
            'name_statistics' => 'Вакансий на рынке'
        ]);
        Statistic::create([
            'quantity' => 70,
            'name_statistics' => 'Заказов на фрилансе'
        ]);
        Statistic::create([
            'quantity' => 500,
            'name_statistics' => 'Дефицит IT-кадров'
        ]);
    }
}
