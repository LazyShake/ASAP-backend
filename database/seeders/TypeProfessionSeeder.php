<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeProfession;

class TypeProfessionSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей с помощью фабрики
        TypeProfession::factory()->count(10)->create();
    }
}
