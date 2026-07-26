<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillCategoryResource;
use App\Models\SkillCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkillController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = SkillCategory::with('skills')
            ->orderBy('sort_order')
            ->get();

        return SkillCategoryResource::collection($categories);
    }
}
