<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FirstImage;
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
            CareerSeeder::class,
            ColorSeeder::class,
            TypeProfessionSeeder::class,
            ProfessionSeeder::class,
            ProgressSeeder::class,
            ProgramSeeder::class,
            FilterSeeder::class,
            ArticleSeeder::class,
            MentorSeeder::class,
            ReviewSeeder::class,
            SkillSeeder::class,
            TagsSeeder::class,
            ReferalSeeder::class,
            TrackerSeeder::class,
            FirstImageSeeder::class,
            PartnerSeeder::class,
            StatisticSeeder::class,
            TestSeeder::class,
            
        ]);
        
    }
}
