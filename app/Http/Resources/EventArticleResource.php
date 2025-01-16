<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'tags' => $this->tags,
            'name_article' => $this->name_article,
            'short_text' => $this->short_text,
            'link' => $this->link,
            'picture' => $this->picture,
        ];
    }
}
