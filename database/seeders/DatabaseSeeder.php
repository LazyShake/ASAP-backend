<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            TypeSeeder::class,
            TrainingPlanSeeder::class,
            TariffSeeder::class,
            ExampleLessonSeeder::class,
            CareerSeeder::class,
            ColorSeeder::class,
            ProfessionSeeder::class,
            ProgressSeeder::class,
            ProgramSeeder::class,
            ArticleSeeder::class,
            MentorSeeder::class,
            ReviewSeeder::class,
            SkillSeeder::class,
        ]);
        
    }
}
