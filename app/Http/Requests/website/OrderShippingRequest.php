<?php

namespace App\Http\Requests\website;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderShippingRequest extends FormRequest
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
     'first_name' => 'required|string|max:255',
     'last_name' => 'required|string|max:255',
      'user_phone' => 'required|string|max:20',
       'user_email' => 'required|email|max:255',
        'country_id' => 'required|exists:countries,id',
         'governrate_id' => 'required|exists:governrates,id',
         'city_id' => 'required|exists:cities,id',
          'street' => 'required|string|max:255',
           'note' => 'nullable|string|max:1000',
            ];
    }
}
