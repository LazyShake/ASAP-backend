<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id_article' => $this->id,
            'name_article' => $this->name_article,
            'content' => $this->content,
            'picture' => $this->picture,
            'date' => $this->date,
            'name_owner' => $this->name_owner,
            'description_owner' => $this->description_owner,
            'photo_owner' => $this->photo_owner,
            'tags' => $this->tags,
        ];
    }
}
