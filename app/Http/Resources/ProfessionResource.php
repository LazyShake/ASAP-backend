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
            'type_profession' => $this->typeProfession->name_type ?? null,
            'color' => $this->color->name ?? null,
            'career' => $this->career ? new CareerResource($this->career) : null,
            'skills' => SkillResource::collection($this->skills),
            'mentors' => MentorResource::collection($this->mentors),
            'reviews' => ReviewResource::collection($this->reviews),
            'progress' => ProgressResource::collection($this->progress),
        ];
    }
}
