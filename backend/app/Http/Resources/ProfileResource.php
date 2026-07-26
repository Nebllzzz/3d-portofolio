<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'full_name'   => $this->full_name,
            'nickname'    => $this->nickname,
            'headline'    => $this->headline,
            'bio'         => $this->bio,
            'birth_place' => $this->birth_place,
            'birth_date'  => $this->birth_date?->toDateString(),
            'address'     => $this->address,
            'phone'       => $this->phone,
            'email'       => $this->email,
            'photo_url'   => $this->photo_path ? Storage::url($this->photo_path) : null,
            'cv_url'      => $this->cv_path ? Storage::url($this->cv_path) : null,
            'socials'     => SocialResource::collection($this->whenLoaded('socials')),
        ];
    }
}
