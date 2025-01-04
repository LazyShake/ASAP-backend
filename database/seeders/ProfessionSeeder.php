<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 профессий с помощью фабрики
        Profession::factory()->count(10)->create();
    }
}
