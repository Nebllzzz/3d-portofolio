<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        Contact::create($request->validated());

        return response()->json([
            'message' => 'Pesan terkirim — aku balas secepatnya.',
        ], 201);
    }
}
