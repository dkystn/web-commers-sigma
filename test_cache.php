<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\BiteshipService;
use Illuminate\Support\Facades\Cache;

echo "Testing Biteship Cache Implementation\n";
echo "=====================================\n\n";

// Test parameters
$origin = ['latitude' => '-6.291974', 'longitude' => '106.801207'];
$destination = ['latitude' => '-6.288941', 'longitude' => '106.806473'];
$couriers = 'grab,gojek';
$items = [['name' => 'Test Item', 'description' => '', 'length' => 10, 'width' => 10, 'height' => 10, 'weight' => 1000, 'value' => 100000, 'quantity' => 1]];

// Create cache key
$cacheKey = 'biteship_rates_' .
    $origin['latitude'] . '_' . $origin['longitude'] . '_' .
    $destination['latitude'] . '_' . $destination['longitude'] . '_' .
    md5($couriers . json_encode($items));

echo "Cache Key: $cacheKey\n\n";

// Clear existing cache for this key
Cache::forget($cacheKey);
echo "Cleared existing cache\n\n";

// First call - should hit API
echo "First call (should hit API):\n";
$startTime = microtime(true);
$service = app()->make(BiteshipService::class);
$result1 = $service->getInstantRates($origin, $destination, $couriers, $items);
$endTime = microtime(true);
$duration1 = $endTime - $startTime;

echo "Duration: " . number_format($duration1, 4) . " seconds\n";
echo "Success: " . (isset($result1['success']) ? ($result1['success'] ? 'Yes' : 'No') : 'Unknown') . "\n";
if (isset($result1['pricing']) && is_array($result1['pricing'])) {
    echo "Number of couriers: " . count($result1['pricing']) . "\n";
}
echo "\n";

// Second call - should use cache
echo "Second call (should use cache):\n";
$startTime = microtime(true);
$result2 = $service->getInstantRates($origin, $destination, $couriers, $items);
$endTime = microtime(true);
$duration2 = $endTime - $startTime;

echo "Duration: " . number_format($duration2, 4) . " seconds\n";
echo "Success: " . (isset($result2['success']) ? ($result2['success'] ? 'Yes' : 'No') : 'Unknown') . "\n";
if (isset($result2['pricing']) && is_array($result2['pricing'])) {
    echo "Number of couriers: " . count($result2['pricing']) . "\n";
}
echo "\n";

// Compare results
$resultsMatch = $result1 === $result2;
echo "Results match: " . ($resultsMatch ? 'Yes' : 'No') . "\n";
echo "Cache speedup: " . ($duration1 > 0 ? number_format(($duration1 - $duration2) / $duration1 * 100, 2) . "%" : 'N/A') . "\n\n";

// Check cache TTL
$cachedData = Cache::get($cacheKey);
if ($cachedData) {
    echo "Cache exists: Yes\n";
    // Note: TTL check depends on cache driver, for database cache we can't easily check remaining TTL
    echo "Cache TTL: 5 minutes (set)\n";
} else {
    echo "Cache exists: No\n";
}

echo "\nTest completed!\n";
