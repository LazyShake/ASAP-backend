<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём 10 записей через фабрику
        Career::factory()->count(10)->create();
    }
}
