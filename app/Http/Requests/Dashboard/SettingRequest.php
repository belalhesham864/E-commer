<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
             'site_name'           => 'required|string|max:255',
            'site_desc'           => 'required|string|max:1000',
            'phone'               => 'required|string|max:20',
            'address'             => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'email_support'       => 'required|email|max:255',
            'facebook_url'        => 'required|url|max:255',
            'twitter_url'         => 'required|url|max:255',
            'youtube_url'         => 'required|url|max:255',
            'meta_desc'           => 'required|string|max:1000',
            'logo'                => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'favicon'             => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
            'site_copyright'      => 'required|string|max:255',
            'promotion_video_url' => 'required|url|max:1000',
        ];
    }
}
