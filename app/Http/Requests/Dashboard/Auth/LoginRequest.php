<?php

namespace App\Http\Requests\Dashboard\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>"required|email",
            'password'=>"required|min:8",
            'remberme'=>'nullable',
        'g-recaptcha-response' => 'required|captcha',
        ];
    }
    public function messages()
    {
        return[

            'g-recaptcha-response.required' => __('auth.verifay_captcha'),
            'g-recaptcha-response.captcha'  => __('auth.error_captcha'),
            ];
    }
}
