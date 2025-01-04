<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tracker;

class TrackerSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей с помощью фабрики
        Tracker::factory()->count(10)->create();
    }
}
