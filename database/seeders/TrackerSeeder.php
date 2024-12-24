<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tracker;

class TrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tracker::create([
            'name_tracker' => 'Alice Johnson',
            'picture' => '/images/mentor-alice.jpg',
            'description' => 'Expert in Frontend Development with 10 years of experience.',
        ]);

        Tracker::create([
            'name_tracker' => 'Bob Brown',
            'picture' => '/images/mentor-bob.jpg',
            'description' => 'Data Scientist specializing in Machine Learning.',
        ]);
    }
}
