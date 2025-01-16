<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 программ с помощью фабрики
        Program::factory()->count(10)->create();
    }
}
