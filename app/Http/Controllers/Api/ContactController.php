<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;

use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        $message = ContactMessage::create($request->validated());
        return response()->json([
            'message' => 'تم ارسال الرسالة بنجاح ستيم التواصل معكم قريبا!',
            'data' => $message
        ], 201);
    }
}
