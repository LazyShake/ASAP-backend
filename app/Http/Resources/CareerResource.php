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
            'hh' => number_format((int) preg_replace('/\D/', '', $this->hh), 0, '.', ' '),
            'habr' => number_format((int) preg_replace('/\D/', '', $this->habr), 0, '.', ' '),
            'freelance' => number_format((int) preg_replace('/\D/', '', $this->freelance), 0, '.', ' '),
            'start_vage' => number_format($this->start_vage, 0, '.', ' '),
            'one_year_vage' => number_format($this->one_year_vage, 0, '.', ' '),
            'three_year_vage' => number_format($this->three_year_vage, 0, '.', ' '),

        ];
    }
}
