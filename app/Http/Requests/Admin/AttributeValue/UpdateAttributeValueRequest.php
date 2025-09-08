<?php

namespace App\Http\Requests\Admin\AttributeValue;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'translations.ru' => ['required', 'string', 'max:255'],
            'translations.ro' => ['required', 'string', 'max:255'],
            'translations.en' => ['required', 'string', 'max:255'],
        ];
    }
}
