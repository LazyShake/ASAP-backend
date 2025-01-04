<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_referal' => $this->id,
            'price' => $this->price,
        ];
    }
}
