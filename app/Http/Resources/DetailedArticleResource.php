<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DetailedArticleResource extends JsonResource
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
            'short_text' => Str::limit($this->short_text, 255), // Краткое описание статьи с лимитом
            'content' => $this->content, // Полный контент статьи
            'picture' => $this->picture, // Изображение
            'link' => $this->link, // Ссылка
            'owner_name' => $this->owner_name, // Имя владельца статьи
            'owner_description' => $this->owner_description, // Описание владельца
            'owner_picture' => $this->owner_picture, // Изображение владельца
            'seo_title' => $this->seo_title, // SEO заголовок
            'seo_description' => $this->seo_description, // SEO описание
            'seo_keywords' => $this->seo_keywords, // SEO ключевые слова
            'date' => $this->date, // Дата публикации
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('j F Y'), // Дата создания
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('j F Y'), // Дата обновления
        ];
    }
}
