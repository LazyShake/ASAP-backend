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
            'price' => $this->price,
            'instalment' => $this->installment,
            'detailed_description' => $this->detailed_description,
        ];
    }
}
