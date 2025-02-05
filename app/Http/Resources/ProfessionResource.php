<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Tariff;

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
            'start_of_training' => Carbon::parse($this->start_of_training)->translatedFormat('j F Y'),
            'place' => $this->place,
            'type' => $this->typeProfession->name_type ?? null,
            'mini_images' => $this->miniimage,
            'image' => $this->image,
            'SEO' => [
                'key_words' => $this->SEO_key_words, // добавлено поле ключевых слов
                'title' => $this->SEO_title, // добавлено поле для заголовка
                'description' => $this->SEO_description, // добавлено поле для описания
            ],
            'mentors' => MentorResource::collection($this->mentors),
            'skills' => SkillResource::collection($this->skills),
            'skilltext' => $this->skilltext, // Добавлено новое поле
            'career' => CareerResource::make($this->career),
            'tariffs' => TariffResource::collection(Tariff::orderBy('price')),
            'programs' => ProgramResource::collection($this->programs),
            'progress' => ProgressResource::collection($this->progress),
            'articles' => ArticleResource::collection($this->articles),
            'reviews' => ReviewResource::collection($this->reviews),
            'color' => $this->color->name,
        ];
    }
}
