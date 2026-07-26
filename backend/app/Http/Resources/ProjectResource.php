<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'summary'     => $this->summary,
            'cover_url'   => $this->cover_path ? Storage::url($this->cover_path) : null,
            'source_url'  => $this->source_url,
            'demo_url'    => $this->demo_url,
            'is_featured' => $this->is_featured,
            'points'      => $this->whenLoaded('points', fn () => $this->points->pluck('point')),
            'tags'        => $this->whenLoaded('tags', fn () => $this->tags->pluck('tag')),
        ];
    }
}
