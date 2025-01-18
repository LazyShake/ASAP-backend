<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionResource extends JsonResource
{
    /**
     * Преобразование ресурса в массив.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_profession' => $this->id_profession,
            'name_profession' => $this->name_profession,
            'description' => $this->description,
            'price' => "От {$this->price} ₽",
            'period' => $this->period,
            'start_of_training' => $this->start_of_training,
            'place' => $this->place,
            'type' => $this->typeProfession->name ?? null,
            'mini_images' => $this->miniimage,
            'SEO' => [
                'key_words' => $this->SEO_key_words, // добавлено поле ключевых слов
                'title' => $this->SEO_title, // добавлено поле для заголовка
                'description' => $this->SEO_description, // добавлено поле для описания
            ],
            'mentors' => MentorResource::collection($this->mentors),
            'skills' => SkillResource::collection($this->skills),
            'career' => CareerResource::make($this->career),
            'training_plan' => TrainingPlanResource::make($this->trainingPlan),
            'programs' => ProgramResource::collection($this->programs),
            'progress' => ProgressResource::collection($this->progress),
            'articles' => ArticleResource::collection($this->articles),
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
