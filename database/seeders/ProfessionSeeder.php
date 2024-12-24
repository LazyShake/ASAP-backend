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
            'image' => 'link',
            'price' => 75000,
            'period' => '4 months',
            'start_of_training' => '2025-02-01',
            'id_career' => 1,
            'place' => 'Online',
            'type' => 'Full-time',
            'id_color' => 1,
            'description' => 'random text',
            'miniimage' => 'link'
        ]);
        
        Profession::create([
            'name_profession' => 'Data Scientist',
            'image' => 'link',
            'price' => 120000,
            'period' => '6 months',
            'start_of_training' => '2025-03-01',
            'id_career' => 2,
            'place' => 'Hybrid',
            'type' => 'Part-time',
            'id_color' => 2,
            'description' => 'random text',
            'miniimage' => 'link'
        ]);
    }
}


