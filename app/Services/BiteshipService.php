<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BiteshipService
{
    protected $apiKey;
    protected $baseUrl;
    protected $isProduction;

    public function __construct()
    {
        $this->apiKey = config('services.biteship.api_key');
        $this->baseUrl = config('services.biteship.base_url');
        $this->isProduction = config('services.biteship.is_production');
    }

    /**
     * Get shipping rates for instant delivery - ONLY REAL API DATA
     */
    public function getInstantRates($origin, $destination, $couriers = 'grab,gojek', $items = [])
    {
        // Create comprehensive cache key based on ALL location parameters
        $cacheKey = 'biteship_rates_' .
            'origin_lat_' . $origin['latitude'] . '_' .
            'origin_lng_' . $origin['longitude'] . '_' .
            'dest_lat_' . $destination['latitude'] . '_' .
            'dest_lng_' . $destination['longitude'] . '_' .
            'couriers_' . md5($couriers) . '_' .
            'items_' . md5(json_encode($items));

        // Check cache first (5 minutes TTL)
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            Log::info('Returning cached Biteship rates data', ['cache_key' => $cacheKey]);
            return $cachedData;
        }

        // Use the parameters passed from controller
        $payload = [
            'origin_latitude' => $origin['latitude'],
            'origin_longitude' => $origin['longitude'],
            'destination_latitude' => $destination['latitude'],
            'destination_longitude' => $destination['longitude'],
            'couriers' => $couriers,
            'items' => $items
        ];

        Log::info('Biteship Rates Request Payload:', ['payload' => $payload]);

        // Try POST request with JSON body (matching Postman)
        try {
            Log::info('Trying POST request with JSON body');

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'PostmanRuntime/7.32.3'
                ])
                ->post('https://api.biteship.com/v1/rates/couriers', $payload);

            Log::info('Response Status:', ['status' => $response->status()]);
            Log::info('Response Headers:', ['headers' => $response->headers()]);
            Log::info('Response Body:', ['body' => $response->body()]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('SUCCESS - Real API Data:', ['data' => $data]);

                // Cache the successful response for 5 minutes
                Cache::put($cacheKey, $data, 300); // 300 seconds = 5 minutes
                Log::info('Cached Biteship rates data', ['cache_key' => $cacheKey, 'ttl' => 300]);

                return $data;
            } else {
                Log::warning('Request failed:', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('POST request failed:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }

        // If POST fails, try curl as fallback
        try {
            Log::info('Trying curl POST as fallback');
            $data = $this->getRatesWithCurlPost($payload);

            if ($data && isset($data['success']) && $data['success']) {
                // Cache the successful response for 5 minutes
                Cache::put($cacheKey, $data, 300);
                Log::info('Cached Biteship rates data from curl fallback', ['cache_key' => $cacheKey, 'ttl' => 300]);
                return $data;
            }
        } catch (\Exception $e) {
            Log::error('Curl also failed:', ['error' => $e->getMessage()]);
        }

        // Only return error if everything fails
        return [
            'success' => false,
            'error' => 'Could not connect to Biteship API after trying all methods',
            'message' => 'Service temporarily unavailable'
        ];
    }

    /**
     * Get rates using curl POST as fallback
     */
    private function getRatesWithCurlPost($payload)
    {
        try {
            // Build JSON payload
            $jsonPayload = json_encode($payload);
            $url = 'https://api.biteship.com/v1/rates/couriers';

            // Use escapeshellarg for security
            $apiKey = escapeshellarg($this->apiKey);
            $jsonData = escapeshellarg($jsonPayload);
            $url = escapeshellarg($url);

            // Execute curl POST command
            $command = 'curl -X POST ' . escapeshellarg($url) . ' -H "Authorization: Bearer ' . $apiKey . '" -H "Content-Type: application/json" -H "User-Agent: PostmanRuntime/7.32.3" -d ' . $jsonData . ' --max-time 60';

            Log::info('Executing curl POST command:', ['command' => $command]);

            $output = shell_exec($command);

            if ($output) {
                Log::info('Curl raw output:', ['output' => substr($output, 0, 500)]); // Limit log size

                $data = json_decode($output, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data['success']) && $data['success']) {
                        Log::info('Curl POST request successful');
                        return $data;
                    } else {
                        Log::warning('Curl POST returned unsuccessful response');
                    }
                } else {
                    Log::error('Curl POST returned invalid JSON:', ['error' => json_last_error_msg()]);
                }
            } else {
                Log::error('Curl POST command returned no output');
            }
        } catch (\Exception $e) {
            Log::error('Curl POST fallback error:', ['message' => $e->getMessage()]);
        }

        return null; // Return null so main method can handle it
    }

    /**
     * Create shipping order
     */
    public function createOrder($orderData)
    {
        try {
            $endpoint = '/v1/orders';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . $endpoint, $orderData);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Biteship Order Creation Error: ' . $response->body());
                return ['error' => 'Failed to create shipping order'];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Order Creation Exception: ' . $e->getMessage());
            return ['error' => 'Service unavailable'];
        }
    }

    /**
     * Get courier information
     */
    public function getCouriers()
    {
        try {
            $endpoint = '/v1/couriers';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . $endpoint);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Biteship Couriers Error: ' . $response->body());
                return ['error' => 'Failed to fetch couriers'];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Couriers Exception: ' . $e->getMessage());
            return ['error' => 'Service unavailable'];
        }
    }
}
