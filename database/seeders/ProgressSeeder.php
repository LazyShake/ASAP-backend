<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    public function run()
    {
        Progress::create([
            'before' => '/images/before_1.jpg',
            'after' => '/images/after_1.jpg',
            'id_profession' => 1,
        ]);

        Progress::create([
            'before' => '/images/before_2.jpg',
            'after' => '/images/after_2.jpg',
            'id_profession' => 2,
        ]);

        Progress::create([
            'before' => '/images/before_3.jpg',
            'after' => '/images/after_3.jpg',
            'id_profession' => 1,
        ]);
    }
}

