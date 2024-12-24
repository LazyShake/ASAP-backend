<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    public function run()
    {
        Profession::create([
            'name_profession' => 'Frontend Developer',
            'price' => 75000,
            'period' => '4 months',
            'start_of_training' => '2025-02-01',
            'tariff_id' => 1,
            'training_plan_id' => 1,
            'example_lesson_id' => 1,
            'id_career' => 1,
            'place' => 'Online',
            'type' => 'Full-time',
            'id_color' => 1,
        ]);
        
        Profession::create([
            'name_profession' => 'Data Scientist',
            'price' => 120000,
            'period' => '6 months',
            'start_of_training' => '2025-03-01',
            'tariff_id' => 2,
            'training_plan_id' => 2,
            'example_lesson_id' => 2,
            'id_career' => 2,
            'place' => 'Hybrid',
            'type' => 'Part-time',
            'id_color' => 2,
        ]);
    }
}


