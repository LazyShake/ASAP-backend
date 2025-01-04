<?php

namespace Database\Seeders;

use App\Models\FirstImage;
use Illuminate\Database\Seeder;

class FirstImageSeeder extends Seeder
{
    public function run(): void
    {
        FirstImage::factory()->count(10)->create();
    }
}
