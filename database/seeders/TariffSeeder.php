<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    public function run()
    {
        Tariff::create([
            'name_tariff' => 'Standard Plan',
            'short_description' => 'Access to all materials for 4 months.',
            'price' => 49999.99,
            'installment' => 'Yes',
            'detailed_description' => 'Includes full access to modules and mentorship.',
        ]);

        Tariff::create([
            'name_tariff' => 'Premium Plan',
            'short_description' => 'Includes personal mentorship and extended access.',
            'price' => 99999.99,
            'installment' => 'Yes',
            'detailed_description' => 'Personalized mentorship with extended access to resources.',
        ]);
    }
}
