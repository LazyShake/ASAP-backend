<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей с помощью фабрики
        Skill::factory()->count(10)->create();
    }
}
