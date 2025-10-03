<?php

return [
    // Стандартные сообщения Laravel
    'required' => 'Поле :attribute обязательно для заполнения.',
    'email' => 'Поле :attribute должно быть корректным email адресом.',
    'min' => [
        'string' => 'Поле :attribute должно содержать минимум :min символов.',
        'array' => 'В :attribute должно быть минимум :min элементов.',
    ],
    'max' => [
        'string' => 'Поле :attribute не может быть длиннее :max символов.',
    ],
    'in' => 'Выбранное значение для :attribute некорректно.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'array' => 'Поле :attribute должно быть массивом.',

    // Кастомные названия атрибутов (чтобы вместо "customer.name" было "Имя")
    'attributes' => [
        'customer.name' => 'Имя',
        'customer.phone' => 'Телефон',
        'customer.email' => 'Email',
        'delivery.method' => 'Способ получения',
        'delivery.address' => 'Адрес',
        'delivery.houseNumber' => 'Номер дома',
        'delivery.apartmentNumber' => 'Номер квартиры',
        'delivery.entrance' => 'Подъезд',
        'delivery.floor' => 'Этаж',
        'payment' => 'Способ оплаты',
        'items' => 'Корзина',
        'comment' => 'Комментарий',
    ],
];
