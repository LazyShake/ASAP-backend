<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_article' => $this->id_article, // ID статьи
            'name_article' => $this->name_article, // Название статьи
            'slug' => $this->slug, // Slug статьи
            'short_text' => Str::limit($this->short_text, 150), // Краткое описание статьи с лимитом
            'content' => $this->content, // Полный текст статьи
            'picture' => $this->picture, // Изображение статьи
            'type' => new TypeResource($this->whenLoaded('type')), // Тип статьи
            'profession' => new ProfessionGeneralResource($this->whenLoaded('profession')), // Профессия
            'filter' => new FilterResource($this->whenLoaded('filter')), // Фильтр
            'tags' => TagResource::collection($this->whenLoaded('tags')), // Теги
            'link' => $this->link, // Ссылка на источник
            'owner_name' => $this->owner_name, // Имя владельца статьи
            'owner_description' => $this->owner_description, // Описание владельца
            'owner_picture' => $this->owner_picture, // Фото владельца
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'keywords' => $this->seo_keywords,
            ], // SEO-данные
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('j F Y'), // Дата создания
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('j F Y'), // Дата обновления
        ];
    }
}
