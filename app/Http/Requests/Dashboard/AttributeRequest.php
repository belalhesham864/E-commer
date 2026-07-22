<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
    protected $stopOnFirstFailure = true;
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:30|unique:attributes,name,'.$this->route('attribute'),
            'value'=>'required|array|min:1',
            'value.*'=>'required|string|max:60|distinct',
               'new_value' => 'nullable|array',
        'new_value.*' => 'nullable|string|max:255',
        ];
    }
       public function messages(): array
    {
        return [
            'name.required' => 'Attribute name is required.',
            'name.unique' => 'This attribute already exists.',

            'value.required' => 'Please add at least one attribute value.',
            'value.min' => 'Please add at least one attribute value.',

            'value.*.required' => 'Attribute value is required.',
            'value.*.distinct' => 'Attribute values must be unique.',
            'value.*.max' => 'Attribute value must not exceed 60 characters.',
        ];
    }
}
