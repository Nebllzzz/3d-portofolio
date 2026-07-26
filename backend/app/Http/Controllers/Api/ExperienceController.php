<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExperienceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $experiences = Experience::with('points')
            ->orderBy('sort_order')
            ->get();

        return ExperienceResource::collection($experiences);
    }
}
