<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run()
    {
        Color::create([
            'name' => 'синий',
        ]);

        Color::create([
            'name' => 'розовый',
        ]);
    }
}
