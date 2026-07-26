<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // Inflector Laravel menganggap "education" uncountable, jadi tabelnya
    // ditebak jadi "education". Skema pakai "educations" — set eksplisit.
    protected $table = 'educations';

    protected $fillable = ['level', 'institution', 'year_start', 'year_end', 'sort_order'];
}
