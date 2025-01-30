<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionPreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_profession' => $this->id_profession,
            'slug' => $this->slug,
            'name_profession' => $this->name_profession,
            'mini_images' => $this->miniimage,
            'place' => $this->place,
            'price' => $this->price,
            'type' => $this->typeProfession->name_type,
            'color' => $this->color->name,
            'tariff' => TariffResource::collection($this->tariff),
        ];
    }
}
