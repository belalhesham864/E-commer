<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $rules= [
            'name.*'=>['required','string','min:2',UniqueTranslationRule::for('categories')->ignore($this->route('brand'))],
            'status'=>'required|in:1,0'
        ];

        if($this->method()=='PUT'){
            $rules['logo']='nullable|image|mimes:jpeg,png,gif,jpg|max:5120';

        }else{
            $rules['logo']='required|image|mimes:jpeg,png,gif,jpg|max:5120';

        }
        return $rules;
    }
}
