<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
      'code' => ['required', 'min:4', 'max:10', 'unique:coupons,code'],

        'discount_precentage' => ['required', 'numeric', 'between:1,100'],

        'start_date' => ['required', 'date', 'after_or_equal:today'],

        'end_date' => ['required', 'date', 'after:start_date'],

        'limit' => ['required', 'numeric', 'min:1'],

        'is_active' => ['required', 'boolean'],
        ];
    }
}
