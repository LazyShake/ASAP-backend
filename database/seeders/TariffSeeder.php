<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tariff;

class TariffSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей с помощью фабрики
        Tariff::factory()->count(10)->create();
    }
}
