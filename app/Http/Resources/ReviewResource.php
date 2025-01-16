<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'text' => $this->text,
            'picture' => $this->picture,
            'video' => $this->video,
            'owner' => $this->owner,
            'status' => $this->status,
            'place_job' => $this->place_job,
            'job_before' => $this->job_before,
            'job_after' => $this->job_after,
        ];
    }
}
