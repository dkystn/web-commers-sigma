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
                // Filter only instant services
                $instantCouriers = array_filter($rates['pricing'], function($courier) {
                    $instantTypes = ['instant', 'instant_bike', 'instant_car', 'motorcycle', 'economy'];
                    return isset($courier['type']) && in_array($courier['type'], $instantTypes);
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
