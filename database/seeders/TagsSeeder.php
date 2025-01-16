<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей с помощью фабрики
        Tags::factory()->count(10)->create();
    }
}
