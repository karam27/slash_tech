<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequestForm;
use App\Mail\ProjectRequestMail;

use Illuminate\Support\Facades\Mail;

class ProjectRequestController extends Controller
{
    public function sendEmail(ProjectRequestForm $request)
    {
        $validated = $request->validated();

        Mail::to('contact@slashtech.co')->send(new ProjectRequestMail($validated));

        return response()->json(['message' => 'تم إرسال الطلب بنجاح']);
    }
}
