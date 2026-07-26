<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'full_name', 'nickname', 'headline', 'bio', 'birth_place',
        'birth_date', 'address', 'phone', 'email', 'photo_path', 'cv_path',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function socials(): HasMany
    {
        return $this->hasMany(Social::class)->orderBy('sort_order');
    }
}
