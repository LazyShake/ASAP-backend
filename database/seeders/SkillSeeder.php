<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run()
    {
        Skill::create([
            'text' => 'HTML, CSS, JavaScript, React',
            'name' => 'Frontend Development',
            'profession_id' => 1, // Предположим, профессия с id_profession = 1 уже существует
        ]);

        Skill::create([
            'text' => 'Python, Machine Learning, Data Analysis',
            'name' => 'Data Science',
            'profession_id' => 2, // Предположим, профессия с id_profession = 2 уже существует
        ]);

        Skill::create([
            'text' => 'Figma, Adobe Photoshop, UI/UX Design',
            'name' => 'Graphic Design',
            'profession_id' => 1, // Предположим, профессия с id_profession = 3 уже существует
        ]);
    }
}
