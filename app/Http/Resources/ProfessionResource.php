<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Tariff;
use App\Models\Article;

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
            'slug' => $this->slug,
            'description' => $this->description,
            'period' => $this->period,
            'start_of_training' => Carbon::parse($this->start_of_training)->translatedFormat('j F Y'),
            'place' => $this->place . ' ' . (in_array($this->place % 10, [2, 3, 4]) && !in_array($this->place % 100, [12, 13, 14]) ? 'человека' : 'человек'),

            'image' => $this->image,
            'mini_images' => $this->miniimage,
            'skilltext' => $this->skilltext,
            'type' => $this->typeProfession->name_type ?? null,
            'color' => $this->color->name ?? null,
            'career' => CareerResource::make($this->career),
            'mentors' => MentorResource::collection($this->mentors),
            'skills' => SkillResource::collection($this->skills),
            'progress' => ProgressResource::collection($this->progress),
            'articles' => ArticleResource::collection($this->articles),
            'programs' => ProgramResource::collection($this->programs),
            'reviews' => ReviewResource::collection($this->reviews),
            'tariffs' => TariffResource::collection(Tariff::orderByDesc('price')->get()),

            // Самая новая статья с типом "Кейс" среди всех статей
            'latest_case' => ArticleResource::make(
                Article::whereHas('type', fn($q) => $q->where('name_type', 'Кейс'))
                    ->orderByDesc('created_at')
                    ->first()
            ),

            // SEO данные
            'SEO' => [
                'key_words' => $this->SEO_key_words,
                'title' => $this->SEO_title,
                'description' => $this->SEO_description,
            ],
        ];
    }
}
