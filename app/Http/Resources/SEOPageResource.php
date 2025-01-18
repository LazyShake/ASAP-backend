<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SEOPageResource extends JsonResource
{
    /**
     * Преобразует ресурс в массив.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // ID SEO записи
            'key_words' => $this->SEO_key_words, // SEO ключевые слова
            'title' => $this->SEO_title, // SEO заголовок
            'description' => $this->SEO_description, // SEO описание
        ];
    }
}
