<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'subtitle', 'date_label', 'sort_order'];

    public function points(): HasMany
    {
        return $this->hasMany(ExperiencePoint::class)->orderBy('sort_order');
    }
}
