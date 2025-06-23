<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'full_name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'message_body' => [
                'required',
                'string',
                'min:10',
            ],
            'phone' => [
                'required',
                'regex:/^\+[1-9]\d{1,14}$/'
            ],
            'exceeds_word_limit' => 'prohibited',
        ];
    }

    public function prepareForValidation(): void
    {
        $message = strip_tags($this->input('message_body') ?? '');
        $wordCount = count(preg_split('/\s+/u', $message, -1, PREG_SPLIT_NO_EMPTY));

        if ($wordCount > 1000) {
            $this->merge([
                'exceeds_word_limit' => true,
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.string' => 'يجب أن يكون الاسم نصًا.',
            'full_name.min' => 'الاسم يجب أن يحتوي على 3 أحرف على الأقل.',
            'full_name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',
            'full_name.regex' => 'الاسم يجب أن يحتوي على حروف ومسافات وشرطات فقط.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' =>  'صيغة البريد الإلكتروني غير صحيحة يجب أن تكون @gmail.com أو @yahoo.com أو @hotmail.com أو حساب شركات.',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفًا.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'رقم الهاتف يجب أن يبدأ بـ "+" ويكون رقم دولي صالح.',

            'message_body.required' => 'نص الرسالة مطلوب.',
            'message_body.string' => 'يجب أن تكون الرسالة نصًا.',
            'message_body.min' => 'الرسالة يجب أن تحتوي على 10 أحرف على الأقل.',

            'exceeds_word_limit.prohibited' => 'نص الرسالة لا يجب أن يتجاوز 1000 كلمة.',
        ];
    }
}
