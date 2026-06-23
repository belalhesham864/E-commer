<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if(request()->isMethod('PUT')){
                return [
            'name.*'=>'required|string|max:50|unique_translation:roles,role,'.request()->route('role'),
            'permission'=>'required|array|min:1'

        ];
        }
        return [
            'name.*'=>'required|string|max:50|unique_translation:roles,role',
            'permission'=>'required|array|min:1'

        ];
    }
}
