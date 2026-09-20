<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'file_name'   => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:10240',
                'product_slug' => 'required|string|min:10',
            ];
        }

        return [
            'file_name'   => 'required|image|mimes:jpg,jpeg,png,svg,webp|max:10240',
            'product_slug' => 'required|string|min:10',
        ];
    }
}
