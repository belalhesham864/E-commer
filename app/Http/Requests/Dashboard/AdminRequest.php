<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
          if(request()->isMethod('PUT')){
              return [
            'name'=>'required|string|between:5,20',
            'email'=>'required|email|unique:admins,email,'. request()->route('admin'),
            'role_id'=>"required|exists:roles,id",
            'status'=>'required|boolean',
        ];
        }
        return [
            'name'=>'required|string|between:5,20',
            'email'=>'required|email|unique:admins,email',
            'role_id'=>"required|exists:roles,id",
            'password'=>'required|min:8',
            'status'=>'required|boolean',
        ];
    }
}
