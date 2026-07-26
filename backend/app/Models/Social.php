<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    protected $fillable = ['profile_id', 'platform', 'label', 'url', 'icon', 'sort_order'];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
