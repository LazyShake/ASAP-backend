<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionGeneralResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name_profession' => $this->name_profession,
            'description' => $this->description,
            'mini_image' => $this->miniimage,
            'type' => $this->typeProfession->name_type,
            'place' => $this->place,
            'period' => $this->period,
        ];
    }
}