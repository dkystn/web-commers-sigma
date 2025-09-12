<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Http;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

echo "Testing Biteship rates endpoint...\n";

$response = Http::withHeaders([
    'Authorization' => 'Bearer biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiVGVzdGluZyBBcGkiLCJ1c2VySWQiOiI2OGMyM2M1YjA2MTg4ZjAwMTJlNGVlYzQiLCJpYXQiOjE3NTc1NjExNDV9.GAWAANu5D_7UqX6_wH6RnvhQtnAR3nzBnWNRcvhuM6s',
    'Content-Type' => 'application/json',
    'User-Agent' => 'PostmanRuntime/7.32.3'
])->post('https://api.biteship.com/v1/rates', [
    'origin_latitude' => '-6.291974',
    'origin_longitude' => ' 106.801207',
    'destination_latitude' => '-6.288941',
    'destination_longitude' => ' 106.806473',
    'couriers' => 'grab,gojek',
    'items' => [['name' => 'Polaris Coffee Cream 330ml isi 3 pcs', 'description' => '', 'length' => 10, 'width' => 10, 'height' => 0, 'weight' => 1000, 'value' => 285600, 'quantity' => 1]]
]);

echo 'Status: ' . $response->status() . PHP_EOL;
echo 'Body: ' . $response->body() . PHP_EOL;
