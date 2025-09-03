<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Midtrans payment gateway integration.
    | You can find your credentials in your Midtrans dashboard.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    /*
    |--------------------------------------------------------------------------
    | Midtrans URLs
    |--------------------------------------------------------------------------
    |
    | URLs for Midtrans API endpoints based on environment.
    |
    */

    'urls' => [
        'production' => 'https://app.midtrans.com/snap/v1/transactions',
        'sandbox' => 'https://app.sandbox.midtrans.com/snap/v1/transactions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | Default currency for transactions.
    |
    */

    'currency' => 'IDR',

    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    |
    | Available payment methods configuration.
    |
    */

    'payment_methods' => [
        'credit_card' => 'Kartu Kredit',
        'bca_va' => 'BCA Virtual Account',
        'bni_va' => 'BNI Virtual Account',
        'bri_va' => 'BRI Virtual Account',
        'mandiri_va' => 'Mandiri Virtual Account',
        'gopay' => 'GoPay',
        'shopeepay' => 'ShopeePay',
        'ovo' => 'OVO',
        'dana' => 'DANA',
        'qris' => 'QRIS',
    ],
];
