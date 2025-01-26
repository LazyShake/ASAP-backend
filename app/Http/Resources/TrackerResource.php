<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name_tracker' => $this->name_tracker,
            'picture' => $this->picture,
            'description' => $this->description,
        ];
    }
}
