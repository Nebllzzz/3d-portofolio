<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'level'       => $this->level,
            'institution' => $this->institution,
            'year_start'  => (int) $this->year_start,
            'year_end'    => (int) $this->year_end,
        ];
    }
}
