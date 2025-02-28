<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tariff;

class ProfessionGeneralResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name_profession' => $this->name_profession,
            'slug' => $this->slug,
            'description' => $this->description,
            'mini_image' => $this->miniimage,
            'type' => $this->typeProfession->name_type,
            'place' => $this->place . ' ' . (
                $this->place % 10 == 1 && $this->place % 100 != 11 ? 'место' : (in_array($this->place % 10, [2, 3, 4]) && !in_array($this->place % 100, [12, 13, 14]) ? 'места' : 'мест')
            ),


            'period' => $this->period,
            'color' => $this->color,
            'tariffs' => TariffResource::collection(Tariff::orderByDesc('price')->get()),
        ];
    }
}
