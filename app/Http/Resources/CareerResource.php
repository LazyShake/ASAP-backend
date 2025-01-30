<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'vacancy' => $this->vacancy,
            'font' => $this->font,
            'hh' => $this->hh,
            'habr' => $this->habr,
            'freelance' => $this->freelance,
            'start_vage' => $this->start_vage,
            'one_year_vage' => $this->one_year_vage,
            'three_year_vage' => $this->three_year_vage,
            'description' => $this->description,
        ];
    }
}
