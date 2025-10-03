<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'customer.name' => 'required|string|max:255',
            'customer.phone' => 'required|string|min:10|max:20',
            'customer.email' => 'nullable|email|max:255',
            'delivery.method' => 'required|in:pickup,delivery',
            'payment' => 'required|in:cash,card',
            'comment' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'deliveryCost' => 'required|numeric|min:0',
            'totalWithDelivery' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
        ];

        if ($this->input('delivery.method') === 'delivery') {
            $rules['delivery.addressType'] = 'required|in:house,apartment';
            $rules['delivery.address'] = 'required|string|max:255';
            $rules['delivery.houseNumber'] = 'required|string|max:50';

            if ($this->input('delivery.addressType') === 'apartment') {
                $rules['delivery.apartmentNumber'] = 'required|string|max:50';
                $rules['delivery.entrance'] = 'required|string|max:50';
                $rules['delivery.floor'] = 'required|string|max:50';
            }
        }

        return $rules;
    }

    // метод messages() больше не нужен!
}
