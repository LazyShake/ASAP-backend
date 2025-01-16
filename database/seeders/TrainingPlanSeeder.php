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
            'image' => 'Link',
        ]);

        TrainingPlan::create([
            'image' => 'Link',
        ]);
    }
}
