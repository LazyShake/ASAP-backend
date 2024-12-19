<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TrainingPlan;
use Illuminate\Database\Seeder;

class TrainingPlanSeeder extends Seeder
{
    public function run()
    {
        TrainingPlan::create([
            'period' => 'Week 1-2',
            'stage' => 'Basics',
            'description_stage' => 'Introduction to tools and basic concepts.',
        ]);

        TrainingPlan::create([
            'period' => 'Week 3-4',
            'stage' => 'Project Work',
            'description_stage' => 'Applying concepts to a real-world project.',
        ]);
    }
}
