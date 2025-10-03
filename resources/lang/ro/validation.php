<?php

return [
    // Mesaje standard Laravel
    'required' => 'Câmpul :attribute este obligatoriu.',
    'email' => 'Câmpul :attribute trebuie să fie o adresă de email validă.',
    'min' => [
        'string' => 'Câmpul :attribute trebuie să conțină minim :min caractere.',
        'array' => ':attribute trebuie să conțină minim :min elemente.',
    ],
    'max' => [
        'string' => 'Câmpul :attribute nu poate depăși :max caractere.',
    ],
    'in' => 'Valoarea selectată pentru :attribute este invalidă.',
    'integer' => 'Câmpul :attribute trebuie să fie un număr întreg.',
    'numeric' => 'Câmpul :attribute trebuie să fie un număr.',
    'array' => 'Câmpul :attribute trebuie să fie un array.',

    // Nume personalizate pentru atribute
    'attributes' => [
        'customer.name' => 'Nume',
        'customer.phone' => 'Telefon',
        'customer.email' => 'Email',
        'delivery.method' => 'Metoda de livrare',
        'delivery.address' => 'Adresa',
        'delivery.houseNumber' => 'Numărul casei',
        'delivery.apartmentNumber' => 'Numărul apartamentului',
        'delivery.entrance' => 'Scara',
        'delivery.floor' => 'Etajul',
        'payment' => 'Metoda de plată',
        'items' => 'Coșul',
        'comment' => 'Comentariu',
    ],
];
