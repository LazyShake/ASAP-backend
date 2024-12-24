<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::create([
            'text' => 'This course changed my life! Highly recommended.',
            'picture' => '/images/review1.jpg',
            'video' => '/videos/review1.mp4',
            'profession_id' => 1,
            'owner' => 'John Doe',
            'status' => True,
            'place_job' => 'Sber',
            'job_before' => 'job1',
            'job_after' => 'job2',
        ]);

        Review::create([
            'text' => 'Excellent mentors and very practical lessons.',
            'picture' => '/images/review2.jpg',
            'video' => '/videos/review2.mp4',
            'profession_id' => 2,
            'owner' => 'Jane Smith',
            'status' => True,
            'place_job' => 'Sber',
            'job_before' => 'job1',
            'job_after' => 'job2',
        ]);
    }
}
