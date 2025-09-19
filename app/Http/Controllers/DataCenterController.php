<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class DataCenterController extends Controller
{
    public function notification(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token || $token !== env('DATA_CENTER_TOKEN')) {
            Log::warning('Unauthorized notification attempt', ['token' => $token]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->all();

        Log::info('Notification received from data center', [
            'event' => $data['event'] ?? null,
            'message' => $data['message'] ?? null,
            'timestamp' => $data['timestamp'] ?? null,
            'full_data' => $data
        ]);

        // Simpan notifikasi ke cache untuk ditampilkan di view
        $notifications = Cache::get('data_center_notifications', []);
        $notifications[] = [
            'event' => $data['event'] ?? 'unknown',
            'message' => $data['message'] ?? 'No message',
            'timestamp' => $data['timestamp'] ?? now()->toISOString(),
            'received_at' => now()->toISOString(),
        ];
        // Simpan maksimal 50 notifikasi terbaru
        if (count($notifications) > 50) {
            $notifications = array_slice($notifications, -50);
        }
        Cache::put('data_center_notifications', $notifications, now()->addDays(7)); // Expire dalam 7 hari

        return response()->json([
            'status' => 'received',
            'message' => 'Notification processed successfully'
        ]);
    }

    public function clearNotifications(Request $request)
    {
        // Bersihkan cache notifikasi
        \Illuminate\Support\Facades\Cache::forget('data_center_notifications');
        return response()->json(['status' => 'cleared']);
    }

    public function product()
    {
        return view('panel.pages.product');
    }

    public function getProduct(Request $request)
    {
        $baseUrl    = env('DATA_CENTER_API_URL') . '/api/products/search?include=category,hppValues,channelPricings,productChannels,bundleItems,bundles,orderItems';
        $token      = env('DATA_CENTER_TOKEN');

        if ($request->has('draw')) {

            $limit  = $request->input('length', 10);
            $start  = $request->input('start', 0);
            $page   = floor($start / $limit) + 1;
            $search = $request->input('search.value', '');

            $url = $baseUrl . '&limit=' . $limit . '&page=' . $page;
            if (!empty($search)) {
                $url .= '&name=' . urlencode($search);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($url);

            if ($response->successful()) {
                $data = $response->json();
                $products = collect($data['data'] ?? []);

                $formattedData = $products->map(function ($row) {
                    return [
                        'action' => '<button class="btn btn-sm btn-outline-primary detail-btn" data-id="' . $row['id'] . '"><i class="align-middle me-1" data-feather="eye"></i>Detail</button>',
                        'id' => $row['id'],
                        'sku' => $row['sku'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'category_name' => $row['category']['name'] ?? 'N/A',
                        'status' => $row['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>',
                    ];
                })->toArray();

                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => $data['total'] ?? count($formattedData),
                    'recordsFiltered' => $data['total'] ?? count($formattedData),
                    'data' => $formattedData
                ]);
            } else {
                return response()->json(['error' => 'Failed to fetch data'], $response->status());
            }
        } else {
            $url = $baseUrl . '&limit=10&page=1';
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($url);

            if ($response->successful()) {
                $data = $response->json()['data'];
                return DataTables::of(collect($data))
                    ->addColumn('action', function ($row) {
                        return '<button class="btn btn-sm btn-outline-primary detail-btn" data-id="' . $row['id'] . '"><i class="align-middle me-1" data-feather="eye"></i>Detail</button>';
                    })
                    ->addColumn('category_name', function ($row) {
                        return $row['category']['name'] ?? 'N/A';
                    })
                    ->addColumn('status', function ($row) {
                        return $row['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            } else {
                return response()->json(['error' => 'Failed to fetch data'], $response->status());
            }
        }
    }

    public function getProductDetail($id)
    {
        $url = env('DATA_CENTER_API_URL') . '/api/products/' . $id . '?include=category,hppValues,channelPricings,productChannels,bundleItems,bundles';
        $token = env('DATA_CENTER_TOKEN');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Failed to fetch product detail'], $response->status());
        }
    }
}
