<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tags;


class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tags::create([
            'name_tag' => 'tag1',
            'id_review' => 1,
        ]);

        Tags::create([
            'name_tag' => 'tag2',
            'id_review' => 2,
        ]);
    }
}
