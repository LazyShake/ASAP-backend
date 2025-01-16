<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей прогресса с помощью фабрики
        Progress::factory()->count(10)->create();
    }
}
