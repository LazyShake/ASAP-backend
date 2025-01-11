<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_training_plan' => $this->id_training_plan,
            'images' => $this->images,
        ];
    }
}
