<?php

namespace App\Http\Requests\Admin\Promotion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // если у тебя есть policy/role middleware — оставляем true
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id'),
                Rule::unique('promotions', 'product_id'), // 1 акция на товар
            ],

            'type' => ['required', 'string', Rule::in(['discount', 'gift'])],

            'title'     => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at'   => ['nullable', 'date', 'after_or_equal:starts_at'],
            'priority'  => ['nullable', 'integer', 'min:0'],

            // Discount
            'discount_price' => [
                'required_if:type,discount',
                'nullable',
                'numeric',
                'min:0',
            ],

            // Gift
            'gift_product_id' => [
                'required_if:type,gift',
                'nullable',
                'integer',
                Rule::exists('products', 'id'),
            ],
            'gift_quantity' => [
                'required_if:type,gift',
                'nullable',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.unique' => 'Для этого товара уже есть акция.',
            'discount_price.required_if' => 'Укажи цену по акции для типа "discount".',
            'gift_product_id.required_if' => 'Укажи товар-подарок для типа "gift".',
            'gift_quantity.required_if' => 'Укажи количество подарка для типа "gift".',
        ];
    }
}
