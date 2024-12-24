<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        Program::create([
            'name_module' => 'Introduction to Frontend Development',
            'content_module' => 'HTML, CSS basics, layout principles',
            'number_module' => 1,
            'id_profession' => 1,
        ]);

        Program::create([
            'name_module' => 'Advanced Data Science',
            'content_module' => 'Machine Learning, Data Visualization',
            'number_module' => 2,
            'id_profession' => 2,
        ]);
    }
}
