<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\BiteshipService;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

echo "Testing Biteship endpoints...\n";

$service = app()->make(BiteshipService::class);

$result = $service->getInstantRates(
    ['latitude' => '-6.291974', 'longitude' => '106.801207'],
    ['latitude' => '-6.288941', 'longitude' => '106.806473'],
    'grab,gojek,paxel,deliveree,borzo,lalamove',
    [['name' => 'Polaris Coffee Cream 330ml isi 3 pcs', 'description' => '', 'length' => 10, 'width' => 10, 'height' => 0, 'weight' => 1000, 'value' => 285600, 'quantity' => 1]]
);

var_dump($result);
