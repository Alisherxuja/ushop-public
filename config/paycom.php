<?php

return [
    'login' => 'Paycom', // Login is always Paycom
    'merchant_id' => env('PAYCOM_MERCHANT_ID'),
    'secret_key' => env('PAYCOM_SECRET_KEY'),
    'endpoint_url' => 'https://checkout.paycom.uz',//env('PAYCOM_ENDPOINT_URL', 'https://checkout.paycom.uz'),
    'min_amount' => 100000,
    'max_amount' => 9000000000,
];
