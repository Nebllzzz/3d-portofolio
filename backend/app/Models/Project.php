<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'summary', 'cover_path',
        'source_url', 'demo_url', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public function points(): HasMany
    {
        return $this->hasMany(ProjectPoint::class)->orderBy('sort_order');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(ProjectTag::class);
    }
}
