<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name.*'=>['required','string','max:100',UniqueTranslationRule::for('categories')->ignore($this->route('category'))],
            'status'=>'required|in:0,1,off,on',
            'parent'=>'nullable|exists:categories,id',
            'icon'=>'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:10240'
        ];
    }
}

