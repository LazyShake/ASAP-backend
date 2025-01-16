<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name_mentors,
            'picture' => $this->picture,
            'description' => $this->description,
            'status' => $this->status,
            'workplace' => $this->workplace,
        ];
    }
}
