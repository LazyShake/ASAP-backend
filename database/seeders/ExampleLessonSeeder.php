<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExampleLesson;
use Illuminate\Database\Seeder;

class ExampleLessonSeeder extends Seeder
{
    public function run()
    {
        ExampleLesson::create([
            'name_example_lesson' => 'HTML Basics',
            'link' => 'https://example.com/html-basics',
        ]);

        ExampleLesson::create([
            'name_example_lesson' => 'Introduction to Python',
            'link' => 'https://example.com/python-intro',
        ]);
    }
}
