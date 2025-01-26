<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name_partners,
            'logo' => $this->logo_partners,
        ];
    }
}