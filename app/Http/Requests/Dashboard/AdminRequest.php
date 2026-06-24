<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'name'=>'required|string|between:5,20',
            'email'=>['required','email',Rule::unique('admins','email')->ignore($this->id)],
            'role_id'=>"required|exists:roles,id",
            'password'=>'required|min:8',
            'status'=>'required|boolean',
        ];
    }
}
