<?php

namespace App\Http\Requests\Admin\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:select,text,number'],
            'unit' => ['nullable', 'string', 'max:50'],
            'is_filterable' => ['boolean'],
            'is_variant' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],

            'translations.ru' => ['required', 'string', 'max:255'],
            'translations.ro' => ['required', 'string', 'max:255'],
            'translations.en' => ['required', 'string', 'max:255'],
        ];
    }
}
