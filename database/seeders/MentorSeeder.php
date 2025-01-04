<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mentor;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 менторов с помощью фабрики
        Mentor::factory()->count(10)->create();
    }
}
