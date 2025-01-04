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
            'id' => $this->id,
            'name_profession' => $this->name_profession,
            'price' => $this->price,
            'description' => $this->description,
            'period' => $this->period,
            'start_of_training' => $this->start_of_training,
            'place' => $this->place,
            'type' => $this->type,
            'color' => $this->color->name ?? null,
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
                'owner' => $review->owner,
                'status' => $review->status,
                'picture' => $review->picture,
            ]),
            'progress' => $this->progress->map(fn($progress) => [
                'before' => $progress->before,
                'after' => $progress->after,
            ]),
        ];
    }
    
}
