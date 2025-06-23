<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'phone' => [
                'required',
                'regex:/^\+[1-9]\d{1,14}$/'
            ],
            'type' => 'required|string',
            'details' => 'required|string|min:10|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'name.min' => 'الاسم يجب أن يكون 3 حروف على الأقل.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 100 حرف.',
            'name.regex' => 'الاسم يحتوي على أحرف غير مسموحة.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' =>  'صيغة البريد الإلكتروني غير صحيحة يجب أن تكون @gmail أو @yahoo أو @hotmail     ',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفًا.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'رقم الهاتف يجب أن يبدأ بـ "+" ويكون رقم دولي صالح.',

            'type.required' => 'نوع المشروع مطلوب.',
            'type.string' => 'نوع المشروع يجب أن يكون نصاً.',

            'details.required' => 'تفاصيل المشروع مطلوبة.',
            'details.string' => 'تفاصيل المشروع يجب أن تكون نصاً.',
            'details.min' => 'تفاصيل المشروع يجب أن تكون 10 حروف على الأقل.',
            'details.max' => 'تفاصيل المشروع لا يجب أن تتجاوز 1000 حرف.',
        ];
    }
}
