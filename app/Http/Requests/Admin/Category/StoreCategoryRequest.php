<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image'     => ['nullable', 'image', 'max:2048'],

            'translations.ru.name' => ['required', 'string', 'max:255'],
            'translations.ro.name' => ['required', 'string', 'max:255'],
            'translations.en.name' => ['required', 'string', 'max:255'],

            'translations.ru.slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('category_translations', 'slug')->where('language', 'ru'),
            ],
            'translations.ro.slug' => ['nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('category_translations', 'slug')->where('language', 'ro'),
            ],
            'translations.en.slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('category_translations', 'slug')->where('language', 'en'),
            ],
        ];
    }
}
