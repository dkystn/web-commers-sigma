<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\BiteshipService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BiteshipServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BiteshipService();
    }

    public function test_getInstantRates_successful_response()
    {
        // Mock Cache: Tidak ada cache sebelumnya
        Cache::shouldReceive('get')->once()->andReturn(null);

        // Mock Http response sukses
        $mockResponse = [
            'success' => true,
            'pricing' => [
                ['courier' => 'grab', 'price' => 15000],
                ['courier' => 'gojek', 'price' => 16000]
            ]
        ];
        Http::shouldReceive('timeout->withHeaders->post')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(true);
        Http::shouldReceive('json')->once()->andReturn($mockResponse);

        // Mock Cache put
        Cache::shouldReceive('put')->once();

        // Mock Log
        Log::shouldReceive('info')->times(4);

        $origin = ['latitude' => '-6.291974', 'longitude' => '106.801207'];
        $destination = ['latitude' => '-6.288941', 'longitude' => '106.806473'];
        $couriers = 'grab,gojek';
        $items = [['name' => 'Test Item', 'weight' => 1000]];

        $result = $this->service->getInstantRates($origin, $destination, $couriers, $items);

        $this->assertTrue($result['success']);
        $this->assertCount(2, $result['pricing']);
    }

    public function test_getInstantRates_cache_hit()
    {
        // Mock Cache hit
        $cachedData = ['success' => true, 'pricing' => [['courier' => 'grab', 'price' => 15000]]];
        Cache::shouldReceive('get')->once()->andReturn($cachedData);

        // Mock Log
        Log::shouldReceive('info')->once();

        $origin = ['latitude' => '-6.291974', 'longitude' => '106.801207'];
        $destination = ['latitude' => '-6.288941', 'longitude' => '106.806473'];
        $couriers = 'grab';
        $items = [];

        $result = $this->service->getInstantRates($origin, $destination, $couriers, $items);

        $this->assertEquals($cachedData, $result);
        // Pastikan Http tidak dipanggil karena cache hit
        Http::shouldNotReceive('post');
    }

    public function test_getInstantRates_api_failure_fallback_to_error()
    {
        // Mock Cache miss
        Cache::shouldReceive('get')->once()->andReturn(null);

        // Mock Http failure
        Http::shouldReceive('timeout->withHeaders->post')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(false);
        Http::shouldReceive('status')->once()->andReturn(500);
        Http::shouldReceive('body')->once()->andReturn('Internal Server Error');

        // Mock Log
        Log::shouldReceive('info')->times(2);
        Log::shouldReceive('warning')->once();

        $origin = ['latitude' => '-6.291974', 'longitude' => '106.801207'];
        $destination = ['latitude' => '-6.288941', 'longitude' => '106.806473'];
        $couriers = 'grab';
        $items = [];

        $result = $this->service->getInstantRates($origin, $destination, $couriers, $items);

        $this->assertFalse($result['success']);
        $this->assertEquals('Could not connect to Biteship API after trying all methods', $result['error']);
    }

    public function test_createOrder_successful()
    {
        $mockResponse = ['success' => true, 'order_id' => '12345'];

        Http::shouldReceive('withHeaders->post')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(true);
        Http::shouldReceive('json')->once()->andReturn($mockResponse);

        $orderData = ['items' => [['name' => 'Test Item']]];
        $result = $this->service->createOrder($orderData);

        $this->assertEquals($mockResponse, $result);
    }

    public function test_createOrder_failure()
    {
        Http::shouldReceive('withHeaders->post')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(false);
        Http::shouldReceive('body')->once()->andReturn('Error message');

        Log::shouldReceive('error')->once();

        $orderData = ['items' => []];
        $result = $this->service->createOrder($orderData);

        $this->assertEquals(['error' => 'Failed to create shipping order'], $result);
    }

    public function test_getCouriers_successful()
    {
        $mockResponse = ['success' => true, 'couriers' => [['name' => 'Grab']]];

        Http::shouldReceive('withHeaders->get')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(true);
        Http::shouldReceive('json')->once()->andReturn($mockResponse);

        $result = $this->service->getCouriers();

        $this->assertEquals($mockResponse, $result);
    }

    public function test_getCouriers_failure()
    {
        Http::shouldReceive('withHeaders->get')
            ->once()
            ->andReturnSelf();
        Http::shouldReceive('successful')->once()->andReturn(false);
        Http::shouldReceive('body')->once()->andReturn('Error');

        Log::shouldReceive('error')->once();

        $result = $this->service->getCouriers();

        $this->assertEquals(['error' => 'Failed to fetch couriers'], $result);
    }
}
