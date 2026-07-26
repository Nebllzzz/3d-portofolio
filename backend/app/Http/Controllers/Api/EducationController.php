<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EducationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $educations = Education::orderBy('sort_order')->get();

        return EducationResource::collection($educations);
    }
}
