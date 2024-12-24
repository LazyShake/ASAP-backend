<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referal;

class ReferalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Referal::create([
            'price' => 40000.00
        ]);

        Referal::create([
            'price' => 54000.00
        ]);
    }
}
