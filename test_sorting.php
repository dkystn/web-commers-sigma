<?php

require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use App\Http\Controllers\BiteshipController;
use App\Services\BiteshipService;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Biteship Controller with Sorting Logic...\n\n";

try {
    $controller = app()->make(BiteshipController::class);
    $request = new Request([
        'latitude' => '-6.288941',
        'longitude' => '106.806473'
    ]);

    $response = $controller->getInstantRates($request);
    $data = json_decode($response->getContent(), true);

    if ($data['success']) {
        echo "✅ SUCCESS - Total couriers: " . count($data['couriers']) . "\n\n";

        echo "📋 TOP 15 COURIERS (Sorted: Gojek/Grab first, then by price):\n";
        echo str_repeat("=", 80) . "\n";

        foreach (array_slice($data['couriers'], 0, 15) as $index => $courier) {
            $num = str_pad($index + 1, 2, ' ', STR_PAD_LEFT);
            $company = strtoupper(str_pad($courier['company'], 10, ' '));
            $service = str_pad($courier['courier_service_name'], 20, ' ');
            $price = str_pad('Rp ' . number_format($courier['price']), 12, ' ', STR_PAD_LEFT);
            $type = $courier['type'] ?? 'N/A';

            echo "{$num}. {$company} | {$service} | {$price} | {$type}\n";
        }

        echo "\n" . str_repeat("=", 80) . "\n";

        // Check if Gojek and Grab are prioritized
        $firstFive = array_slice($data['couriers'], 0, 5);
        $gojekGrabCount = 0;
        foreach ($firstFive as $courier) {
            if (in_array(strtolower($courier['company']), ['gojek', 'grab'])) {
                $gojekGrabCount++;
            }
        }

        echo "🎯 PRIORITY CHECK: {$gojekGrabCount}/5 top results are Gojek or Grab\n";

    } else {
        echo "❌ ERROR: " . ($data['message'] ?? 'Unknown error') . "\n";
    }

} catch (Exception $e) {
    echo "❌ EXCEPTION: " . $e->getMessage() . "\n";
}
