<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_program' => $this->id_program,
            'number_module' => $this->number_module,
            'name_module' => $this->name_module,
            'content_module' => $this->content_module,
        ];
    }
}
