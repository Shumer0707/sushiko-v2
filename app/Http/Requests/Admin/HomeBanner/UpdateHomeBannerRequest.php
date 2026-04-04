<?php

namespace App\Http\Requests\Admin\HomeBanner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        $rules = [
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'overlay_opacity' => ['nullable', 'integer', 'min:0', 'max:100'],
            'link' => ['nullable', 'string', 'max:2048'],
            'open_in_new_tab' => ['nullable', 'boolean'],
        ];

        foreach (['ru', 'ro', 'en'] as $lang) {
            $rules["translations.{$lang}.title"] = ['nullable', 'string', 'max:255'];
            $rules["translations.{$lang}.description"] = ['nullable', 'string', 'max:2000'];
            $rules["translations.{$lang}.button_text"] = ['nullable', 'string', 'max:255'];
            $rules["translations.{$lang}.image_desktop"] = ['nullable', 'image', 'max:4096'];
            $rules["translations.{$lang}.image_mobile"] = ['nullable', 'image', 'max:4096'];
        }

        return $rules;
    }
}
