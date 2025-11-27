<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        $uniqueSlug = fn(string $lang) =>
        Rule::unique('product_translations', 'slug')
            ->where(fn($q) => $q->where('language', $lang));

        return [
            'brand_id'    => ['nullable', 'exists:brands,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'sku'         => ['required', 'string', 'max:100', Rule::unique('products', 'sku')],
            'price'       => ['required', 'numeric', 'min:0'],
            'currency'    => ['nullable', 'string', 'size:3'],
            'is_active'   => ['nullable', 'boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],

            'translations.ru.name' => ['required', 'string', 'max:255'],
            'translations.ro.name' => ['required', 'string', 'max:255'],
            'translations.en.name' => ['required', 'string', 'max:255'],

            'translations.ru.slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', $uniqueSlug('ru')],
            'translations.ro.slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', $uniqueSlug('ro')],
            'translations.en.slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', $uniqueSlug('en')],

            'translations.*.short_description' => ['nullable', 'string'],
            'translations.*.full_description'  => ['nullable', 'string'],

            // 🔹 изображения
            'images'            => ['nullable', 'array'],
            'images.*'          => ['file', 'image', 'max:4096'],

            // индексы основной и small-картинки
            'main_image_index'  => ['required_with:images', 'nullable', 'integer', 'min:0'],
            'small_image_index' => ['required_with:images', 'nullable', 'integer', 'min:0'],

            // 🔹 атрибуты (формат attribute_id => [value_id, ...])
            'attributes'     => ['nullable', 'array'],
            'attributes.*'   => ['array'],
            'attributes.*.*' => ['integer', 'exists:attribute_values,id'],
        ];
    }
}
