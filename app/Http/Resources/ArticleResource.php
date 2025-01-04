<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Трансформировать ресурс в массив.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_article,
            'name' => $this->name_article,
            'text' => $this->text,
            'picture' => $this->picture,
            'type' => $this->type ? $this->type->name : null,
            'profession' => $this->profession ? $this->profession->name : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
