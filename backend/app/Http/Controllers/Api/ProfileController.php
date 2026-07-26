<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    public function show(): ProfileResource
    {
        $profile = Profile::with('socials')->first();

        if (! $profile) {
            throw new NotFoundHttpException('Profil belum diisi.');
        }

        return new ProfileResource($profile);
    }
}
