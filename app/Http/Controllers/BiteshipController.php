<?php

namespace App\Http\Controllers;

use App\Services\BiteshipService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BiteshipController extends Controller
{
    protected $biteshipService;

    public function __construct(BiteshipService $biteshipService)
    {
        $this->biteshipService = $biteshipService;
    }

    /**
     * Get instant shipping rates
     */
    public function getInstantRates(Request $request): JsonResponse
    {
        try {
            // Handle both old format (origin_latitude, destination_latitude) and new format (latitude, longitude)
            if ($request->has('latitude') && $request->has('longitude')) {
                // New simplified format
                $origin = [
                    'latitude' => '-6.291974', // Gudang Sigma coordinates
                    'longitude' => '106.801207'
                ];

                $destination = [
                    'latitude' => $request->input('latitude'),
                    'longitude' => $request->input('longitude')
                ];

                $couriers = 'grab,gojek,paxel,deliveree,borzo,lalamove';
                $items = [
                    [
                        'name' => 'Etawalin Premium Box 200gr',
                        'description' => 'Box 200gr',
                        'length' => 20,
                        'width' => 15,
                        'height' => 10,
                        'weight' => 200,
                        'value' => 185000,
                        'quantity' => 1
                    ],
                    [
                        'name' => 'Vitamin Complete Botol 250ml',
                        'description' => 'Botol 250ml',
                        'length' => 10,
                        'width' => 10,
                        'height' => 25,
                        'weight' => 300,
                        'value' => 165000,
                        'quantity' => 1
                    ]
                ];
            } else {
                // Old format validation
                $request->validate([
                    'origin_latitude' => 'required|numeric',
                    'origin_longitude' => 'required|numeric',
                    'destination_latitude' => 'required|numeric',
                    'destination_longitude' => 'required|numeric',
                    'couriers' => 'sometimes|string',
                    'items' => 'sometimes|array'
                ]);

                $origin = [
                    'latitude' => $request->input('origin_latitude'),
                    'longitude' => $request->input('origin_longitude')
                ];

                $destination = [
                    'latitude' => $request->input('destination_latitude'),
                    'longitude' => $request->input('destination_longitude')
                ];

                $couriers = $request->input('couriers', 'grab,gojek');
                $items = $request->input('items', []);
            }

            $rates = $this->biteshipService->getInstantRates($origin, $destination, $couriers, $items);

            // Handle API error responses
            if (isset($rates['success']) && $rates['success'] === false) {
                return response()->json([
                    'success' => false,
                    'message' => $rates['error'] ?? 'Failed to get shipping rates'
                ], 400);
            }

            // Handle successful API response with pricing data
            if (isset($rates['pricing']) && is_array($rates['pricing'])) {
                // Filter for instant and same-day services - more inclusive filtering
                $instantCouriers = array_filter($rates['pricing'], function($courier) {
                    $instantTypes = ['instant', 'instant_bike', 'instant_car', 'motorcycle', 'economy'];
                    $serviceType = $courier['service_type'] ?? '';
                    $type = $courier['type'] ?? '';
                    $serviceName = strtolower($courier['courier_service_name'] ?? '');
                    $company = strtolower($courier['company'] ?? '');

                    // Priority 1: Check service_type "instant"
                    if ($serviceType === 'instant') {
                        return true;
                    }

                    // Priority 2: Check instant types (including motorcycle)
                    if (in_array($type, $instantTypes)) {
                        return true;
                    }

                    // Priority 3: Include same_day services with instant types
                    if ($serviceType === 'same_day' && in_array($type, ['instant', 'instant_bike', 'instant_car', 'motorcycle'])) {
                        return true;
                    }

                    // Priority 4: Include same_day services from major instant couriers
                    if ($serviceType === 'same_day' && in_array($company, ['grab', 'gojek', 'borzo', 'lalamove', 'paxel', 'deliveree'])) {
                        return true;
                    }

                    // Priority 5: Check service name for instant/same day keywords
                    if (strpos($serviceName, 'instant') !== false ||
                        strpos($serviceName, 'express') !== false ||
                        strpos($serviceName, 'same day') !== false ||
                        strpos($serviceName, 'sameday') !== false) {
                        return true;
                    }

                    // Priority 6: Include economy services from instant couriers
                    if ($serviceType === 'economy' && in_array($company, ['grab', 'gojek', 'borzo', 'lalamove', 'paxel'])) {
                        return true;
                    }

                    // Exclude non-relevant services
                    return false;
                });

                // Sort results: Priority Gojek & Grab first, then by price (cheapest first)
                usort($instantCouriers, function($a, $b) {
                    $companyA = strtolower($a['company'] ?? '');
                    $companyB = strtolower($b['company'] ?? '');
                    $priceA = $a['price'] ?? 0;
                    $priceB = $b['price'] ?? 0;

                    // Priority 1: Gojek and Grab always first
                    $priorityCompanies = ['gojek', 'grab'];
                    $isPriorityA = in_array($companyA, $priorityCompanies);
                    $isPriorityB = in_array($companyB, $priorityCompanies);

                    if ($isPriorityA && !$isPriorityB) {
                        return -1; // A comes first
                    } elseif (!$isPriorityA && $isPriorityB) {
                        return 1; // B comes first
                    }

                    // Priority 2: Within same priority group or non-priority, sort by price (cheapest first)
                    if ($priceA !== $priceB) {
                        return $priceA <=> $priceB;
                    }

                    // If prices are equal, maintain original order
                    return 0;
                });

                return response()->json([
                    'success' => true,
                    'couriers' => array_values($instantCouriers)
                ]);
            }

            // Handle API error responses
            if (isset($rates['success']) && $rates['success'] === false) {
                return response()->json([
                    'success' => false,
                    'message' => $rates['error'] ?? 'Failed to get shipping rates from API',
                    'details' => $rates['message'] ?? 'Service temporarily unavailable'
                ], 503);
            }

            // Fallback for other response formats
            return response()->json([
                'success' => false,
                'message' => 'Invalid response format from Biteship API'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Biteship Controller Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test Biteship connection
     */
    public function testConnection(): JsonResponse
    {
        $testData = [
            'origin_latitude' => '-6.291974',
            'origin_longitude' => '106.801207',
            'destination_latitude' => '-6.288941',
            'destination_longitude' => '106.806473',
            'couriers' => 'grab,gojek,paxel,deliveree,borzo,lalamove',
            'items' => [
                [
                    'name' => 'Polaris Coffee Cream 330ml isi 3 pcs',
                    'description' => '',
                    'length' => 10,
                    'width' => 10,
                    'height' => 0,
                    'weight' => 1000,
                    'value' => 285600,
                    'quantity' => 1
                ]
            ]
        ];

        $result = $this->biteshipService->getInstantRates(
            ['latitude' => $testData['origin_latitude'], 'longitude' => $testData['origin_longitude']],
            ['latitude' => $testData['destination_latitude'], 'longitude' => $testData['destination_longitude']],
            $testData['couriers'],
            $testData['items']
        );

        return response()->json([
            'test_data' => $testData,
            'result' => $result,
            'config' => [
                'api_key_present' => config('services.biteship.api_key') ? true : false,
                'base_url' => config('services.biteship.base_url'),
                'is_production' => config('services.biteship.is_production')
            ]
        ]);
    }
}
