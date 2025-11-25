<?php

return [
    'free_delivery_amount' => (int) env('FREE_DELIVERY_AMOUNT', 600),
    'delivery_cost' => (int) env('DELIVERY_COST', 50),
    'email_shop' => (string) env('EMAIL_SHOP', 'sushikoevgheni@gmail.com'),
    'phone_shop' => (string) env('PHONE_SHOP', '+ 373 78 12 55 33'),
    'work_time' => (string) env('WORK_TIME', '11:00 - 21:45'),
];
