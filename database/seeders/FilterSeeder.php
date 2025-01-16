<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filter;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаём 5 записей через фабрику
        Filter::factory()->count(5)->create();
    }
}
