<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        // Используем фабрику для создания записей
        Type::create([
            'id_type' => 1,
            'name_type' => 'Другое'
        ]);
        Type::create([
            'id_type' => 2,
            'name_type' => 'Кейс'
        ]);
        Type::create([
            'id_type' => 3,
            'name_type' => 'Мероприятие'
        ]);
        Type::create([
            'id_type' => 4,
            'name_type' => 'Для профессии'
        ]);
    }
}
