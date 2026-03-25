<?php

namespace App\Http\Requests\Admin\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicStatusContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'is_disabled' => ['required', 'boolean'],
            'content' => ['required', 'array'],
            'content.ru.title' => ['required', 'string', 'max:255'],
            'content.ru.text' => ['required', 'string', 'max:5000'],
            'content.ru.note' => ['nullable', 'string', 'max:1000'],
            'content.ro.title' => ['required', 'string', 'max:255'],
            'content.ro.text' => ['required', 'string', 'max:5000'],
            'content.ro.note' => ['nullable', 'string', 'max:1000'],
            'content.en.title' => ['required', 'string', 'max:255'],
            'content.en.text' => ['required', 'string', 'max:5000'],
            'content.en.note' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
