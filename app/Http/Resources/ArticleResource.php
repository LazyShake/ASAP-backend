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
            'picture' => $this->picture,
            'name_article' => $this->name_article,
            'date' => $this->date,
            'short_text' => Str::limit($this->short_text, 255), // Ограничение по количеству символов
        ];
    }
}
