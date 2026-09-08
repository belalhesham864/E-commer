<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>"required|string|min:3",
            'email'=>"required|email|unique:users,email",
            'phone'=>'required|numeric|unique:users,phone',
            'password'=>"required|string|min:8",
            'country_id'=>'required|exists:countries,id',
            'governrate_id'=>'required|exists:governrates,id',
            'city_id'=>'required|exists:cities,id',
        ];
    }
}
