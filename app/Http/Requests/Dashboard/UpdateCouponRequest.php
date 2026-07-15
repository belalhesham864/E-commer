<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
            'code' => [
                'required',
                'min:4',
                'max:10',
                Rule::unique('coupons', 'code')->ignore($this->route('coupon')),
            ],

            'discount_precentage' => ['required', 'numeric', 'between:1,100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'limit' => ['required', 'numeric', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
