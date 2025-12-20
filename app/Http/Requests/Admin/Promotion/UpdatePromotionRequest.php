<?php

namespace App\Http\Requests\Admin\Promotion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = (int) $this->route('id'); // потому что в роуте у тебя {id}

        return [
            'product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id'),
                Rule::unique('promotions', 'product_id')->ignore($id),
            ],

            'type' => ['required', 'string', Rule::in(['discount', 'gift'])],

            'title'     => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at'   => ['nullable', 'date', 'after_or_equal:starts_at'],
            'priority'  => ['nullable', 'integer', 'min:0'],

            'discount_price' => [
                'required_if:type,discount',
                'nullable',
                'numeric',
                'min:0',
            ],

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
}
