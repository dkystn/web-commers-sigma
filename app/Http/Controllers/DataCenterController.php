<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

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
}
