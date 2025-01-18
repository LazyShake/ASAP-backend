<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'short_text' => Str::limit($this->short_text, 150), // Краткое описание статьи с лимитом для превью
            'picture' => $this->picture, // Изображение для превью
            'link' => $this->link, // Ссылка на полную статью
            'owner_name' => $this->owner_name, // Имя владельца статьи
            'owner_picture' => $this->owner_picture, // Фото владельца
            'date' => $this->date, // Дата публикации
        ];
    }
}
