<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_profession' => $this->id_profession,
            'name_profession' => $this->name_profession,
            'image' => $this->image,
            'price' => $this->price,
            'description' => $this->description,
            'period' => $this->period,
            'start_of_training' => $this->start_of_training,
            'place' => $this->place,
            'typeProfession' => $this->typeProfession->name_type ?? null,
            'color' => $this->color->name ?? null,
            'career' => $this->career ? [
                'name' => $this->career->name,
                'price' => $this->career->price,
                'vacancy' => $this->career->vacancy,
                'images_vacancy' => $this->career->images_vacancy,
            ] : null,
            'skills' => $this->skills->map(fn($skill) => [
                'name' => $skill->name,
                'text' => $skill->text,
            ]),
            'mentors' => $this->mentors->map(fn($mentor) => [
                'name' => $mentor->name_mentors,
                'picture' => $mentor->picture,
                'description' => $mentor->description,
                'status' => $mentor->status,
                'workplace' => $mentor->workplace,
            ]),
            'reviews' => $this->reviews->map(fn($review) => [
                'text' => $review->text,
                'picture' => $review->picture,
                'video' => $review->video,
                'owner' => $review->owner,
                'status' => $review->status,
                'place_job' => $review->place_job,
                'job_before' => $review->job_before,
                'job_after' => $review->job_after,
            ]),
            'progress' => $this->progress->map(fn($progress) => [
                'before' => $progress->before,
                'after' => $progress->after,
            ]),
        ];
    }
    
}
