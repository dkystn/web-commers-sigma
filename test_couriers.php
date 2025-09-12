<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Http;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

echo "Testing Biteship couriers endpoint...\n";

$response = Http::withHeaders([
    'Authorization' => 'Bearer biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiVGVzdGluZyBBcGkiLCJ1c2VySWQiOiI2OGMyM2M1YjA2MTg4ZjAwMTJlNGVlYzQiLCJpYXQiOjE3NTc1NjExNDV9.GAWAANu5D_7UqX6_wH6RnvhQtnAR3nzBnWNRcvhuM6s'
])->get('https://api.biteship.com/v1/couriers');

echo 'Status: ' . $response->status() . PHP_EOL;
echo 'Body: ' . $response->body() . PHP_EOL;
