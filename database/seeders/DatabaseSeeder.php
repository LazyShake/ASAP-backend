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
            ColorSeeder::class,
            ReferalSeeder::class,
            StatisticSeeder::class,
            AssignRolesSeeder::class,
            
        ]);
        
    }
}
