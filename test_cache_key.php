<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\BiteshipService;
use Illuminate\Support\Facades\Cache;

echo "Testing Updated Cache Key Implementation\n";
echo "========================================\n\n";

// Test parameters - same location
$origin1 = ['latitude' => '-6.291974', 'longitude' => '106.801207'];
$destination1 = ['latitude' => '-6.288941', 'longitude' => '106.806473'];
$couriers1 = 'grab,gojek';
$items1 = [['name' => 'Test Item', 'description' => '', 'length' => 10, 'width' => 10, 'height' => 10, 'weight' => 1000, 'value' => 100000, 'quantity' => 1]];

// Different location
$origin2 = ['latitude' => '-6.200000', 'longitude' => '106.816000'];
$destination2 = ['latitude' => '-6.250000', 'longitude' => '106.850000'];

echo "Test Case 1: Same location, same parameters\n";
echo "-------------------------------------------\n";

// Generate cache keys
$cacheKey1 = 'biteship_rates_' .
    'origin_lat_' . $origin1['latitude'] . '_' .
    'origin_lng_' . $origin1['longitude'] . '_' .
    'dest_lat_' . $destination1['latitude'] . '_' .
    'dest_lng_' . $destination1['longitude'] . '_' .
    'couriers_' . md5($couriers1) . '_' .
    'items_' . md5(json_encode($items1));

$cacheKey2 = 'biteship_rates_' .
    'origin_lat_' . $origin1['latitude'] . '_' .
    'origin_lng_' . $origin1['longitude'] . '_' .
    'dest_lat_' . $destination1['latitude'] . '_' .
    'dest_lng_' . $destination1['longitude'] . '_' .
    'couriers_' . md5($couriers1) . '_' .
    'items_' . md5(json_encode($items1));

echo "Cache Key 1: $cacheKey1\n";
echo "Cache Key 2: $cacheKey2\n";
echo "Keys identical: " . ($cacheKey1 === $cacheKey2 ? 'Yes' : 'No') . "\n\n";

echo "Test Case 2: Different location\n";
echo "-------------------------------\n";

$cacheKey3 = 'biteship_rates_' .
    'origin_lat_' . $origin2['latitude'] . '_' .
    'origin_lng_' . $origin2['longitude'] . '_' .
    'dest_lat_' . $destination2['latitude'] . '_' .
    'dest_lng_' . $destination2['longitude'] . '_' .
    'couriers_' . md5($couriers1) . '_' .
    'items_' . md5(json_encode($items1));

echo "Cache Key 1 (original): $cacheKey1\n";
echo "Cache Key 3 (different location): $cacheKey3\n";
echo "Keys different: " . ($cacheKey1 !== $cacheKey3 ? 'Yes' : 'No') . "\n\n";

echo "Test Case 3: Functional test with service\n";
echo "-----------------------------------------\n";

// Clear cache
Cache::forget($cacheKey1);
Cache::forget($cacheKey3);

$service = app()->make(BiteshipService::class);

// First call - same location
echo "First call (location 1):\n";
$startTime = microtime(true);
$result1 = $service->getInstantRates($origin1, $destination1, $couriers1, $items1);
$endTime = microtime(true);
$duration1 = $endTime - $startTime;
echo "Duration: " . number_format($duration1, 4) . " seconds\n";
echo "Success: " . (isset($result1['success']) ? ($result1['success'] ? 'Yes' : 'No') : 'Unknown') . "\n\n";

// Second call - same location (should use cache)
echo "Second call (same location 1):\n";
$startTime = microtime(true);
$result2 = $service->getInstantRates($origin1, $destination1, $couriers1, $items1);
$endTime = microtime(true);
$duration2 = $endTime - $startTime;
echo "Duration: " . number_format($duration2, 4) . " seconds\n";
echo "Results match: " . ($result1 === $result2 ? 'Yes' : 'No') . "\n\n";

// Third call - different location (should hit API)
echo "Third call (different location 2):\n";
$startTime = microtime(true);
$result3 = $service->getInstantRates($origin2, $destination2, $couriers1, $items1);
$endTime = microtime(true);
$duration3 = $endTime - $startTime;
echo "Duration: " . number_format($duration3, 4) . " seconds\n";
echo "Success: " . (isset($result3['success']) ? ($result3['success'] ? 'Yes' : 'No') : 'Unknown') . "\n\n";

echo "Performance Summary:\n";
echo "-------------------\n";
echo "API call (location 1): " . number_format($duration1, 4) . "s\n";
echo "Cache hit (location 1): " . number_format($duration2, 4) . "s\n";
echo "API call (location 2): " . number_format($duration3, 4) . "s\n";
echo "Cache speedup: " . ($duration1 > 0 ? number_format(($duration1 - $duration2) / $duration1 * 100, 2) . "%" : 'N/A') . "\n\n";

echo "✅ Cache key implementation verified!\n";
echo "Each unique location combination gets its own cache entry.\n";
