<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Mentor;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    public function run()
    {
        Mentor::create([
            'name_mentors' => 'Alice Johnson',
            'picture' => '/images/mentor-alice.jpg',
            'description' => 'Expert in Frontend Development with 10 years of experience.',
            'role' => 'Frontend Mentor',
            'id_profession' => 1,
        ]);

        Mentor::create([
            'name_mentors' => 'Bob Brown',
            'picture' => '/images/mentor-bob.jpg',
            'description' => 'Data Scientist specializing in Machine Learning.',
            'role' => 'Data Science Mentor',
            'id_profession' => 2,
        ]);
    }
}
