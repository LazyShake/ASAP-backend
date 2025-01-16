<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Генерация 10 записей отзыва с помощью фабрики
        Review::factory()->count(10)->create();
    }
}
