<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TariffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name_tariff' => $this->name_tariff,
            'short_description' => $this->short_description,
            'price' => number_format($this->price, 0, '.', ' '),
            'instalment' => number_format((int) preg_replace('/\D/', '', $this->instalment), 0, '.', ' '),

            'detailed_description' => $this->detailed_description,
        ];
    }
}
