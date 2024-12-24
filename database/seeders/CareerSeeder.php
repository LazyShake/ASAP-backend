<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run()
    {
        Career::create([
            'name' => 'Web Developer',
            'price' => 50000.00,
            'vacancy' => 'Frontend Developer',
            'images_vacancy' => '/images/web_developer.jpg',
        ]);

        Career::create([
            'name' => 'Data Scientist',
            'price' => 75000.00,
            'vacancy' => 'Machine Learning Specialist',
            'images_vacancy' => '/images/data_scientist.jpg',
        ]);

        Career::create([
            'name' => 'Graphic Designer',
            'price' => 45000.00,
            'vacancy' => 'UI/UX Designer',
            'images_vacancy' => '/images/graphic_designer.jpg',
        ]);
    }
}
