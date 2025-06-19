<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ProjectRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectRequestController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'type' => 'required|string',
            'details' => 'required|string',
        ]);
        Mail::to('test@example.com')->send(new ProjectRequestMail($validated));
        return response()->json(['message' => 'تم إرسال الطلب بنجاح']);
    }
}
