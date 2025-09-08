<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends StoreProductRequest
{
    public function rules(): array
    {
        $productId = (int) $this->route('id');

        $uniqueSlug = fn(string $lang) =>
        Rule::unique('product_translations', 'slug')
            ->where(fn($q) => $q->where('language', $lang))
            ->where(fn($q) => $q->where('product_id', '!=', $productId));

        return [
            'brand_id'    => ['nullable', 'exists:brands,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'sku'         => ['sometimes', 'required', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],
            'price'       => ['sometimes', 'required', 'numeric', 'min:0'],
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

            // изображения
            'images'            => ['nullable', 'array'],
            'images.*'          => ['file', 'image', 'max:4096'],

            // удаление картинок
            'delete_image_ids'  => ['nullable', 'array'],
            'delete_image_ids.*' => [
                'integer',
                Rule::exists('product_images', 'id')->where(fn($q) => $q->where('product_id', $productId)),
            ],

            // назначение главной картинки
            'main_image_id'     => [
                'nullable',
                'integer',
                Rule::exists('product_images', 'id')->where(fn($q) => $q->where('product_id', $productId)),
            ],

            // сортировка картинок
            'images_sort'       => ['nullable', 'array'],

            // 🔹 атрибуты (формат attribute_id => [value_id, ...])
            'attributes'        => ['nullable', 'array'],
            'attributes.*'      => ['array'],
            'attributes.*.*'    => ['integer', 'exists:attribute_values,id'],
        ];
    }
}
