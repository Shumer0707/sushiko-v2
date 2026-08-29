<?php

return [
    'free_delivery_amount' => (int) env('FREE_DELIVERY_AMOUNT', 600),
    'delivery_cost' => (int) env('DELIVERY_COST', 50),
    'email_shop' => (string) env('EMAIL_SHOP', 'sushikoevgheni@gmail.com'),
    'phone_shop' => (string) env('PHONE_SHOP', '+ 373 78 12 55 33'),
    'work_time' => (string) env('WORK_TIME', '11:00 - 21:45'),
    'latitude_shop' => (float) env('LATITUDE_SHOP', 47.0172663050669),
    'longitude_shop' => (float) env('LONGITUDE_SHOP', 28.848690504971803),
    'map_url' => (string) env('MAP_URL', 'https://www.google.com/maps/search/?api=1&query=Ismail%2086%2C%20Chisinau%2C%20Moldova'),
    'instagram_url' => (string) env('INSTAGRAM_URL', 'https://instagram.com/sushiko.md'),
    'facebook_url' => (string) env('FACEBOOK_URL', 'https://facebook.com/sushiko.md'),
    'telegram_url' => (string) env('TELEGRAM_URL', 'https://t.me/sushiko'),
];
