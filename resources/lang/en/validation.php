<?php

return [
    // Standard Laravel messages
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'in' => 'The selected :attribute is invalid.',
    'integer' => 'The :attribute must be an integer.',
    'numeric' => 'The :attribute must be a number.',
    'array' => 'The :attribute must be an array.',

    // Custom attribute names
    'attributes' => [
        'customer.name' => 'Name',
        'customer.phone' => 'Phone',
        'customer.email' => 'Email',
        'delivery.method' => 'Delivery method',
        'delivery.address' => 'Address',
        'delivery.houseNumber' => 'House number',
        'delivery.apartmentNumber' => 'Apartment number',
        'delivery.entrance' => 'Entrance',
        'delivery.floor' => 'Floor',
        'payment' => 'Payment method',
        'items' => 'Cart',
        'comment' => 'Comment',
    ],
];
