<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        // Используем фабрику для создания записей
        Type::factory()->count(10)->create();  // Создадим 10 записей с фейковыми данными
    }
}
