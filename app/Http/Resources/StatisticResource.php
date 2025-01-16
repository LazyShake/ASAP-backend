<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name_statistics' => $this->name_statistics,
            'quantity' => $this->quantity,
        ];
    }
}