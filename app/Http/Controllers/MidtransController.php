<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();

            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            Log::info('Midtrans Notification', [
                'order_id' => $orderId,
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'fraud_status' => $fraud
            ]);

            // Here you would update your order status based on the notification
            // For example:
            // $order = Order::where('order_id', $orderId)->first();
            // if ($order) {
            //     switch ($transaction) {
            //         case 'capture':
            //             if ($type == 'credit_card') {
            //                 if ($fraud == 'challenge') {
            //                     $order->status = 'challenge';
            //                 } else {
            //                     $order->status = 'success';
            //                 }
            //             }
            //             break;
            //         case 'settlement':
            //             $order->status = 'success';
            //             break;
            //         case 'pending':
            //             $order->status = 'pending';
            //             break;
            //         case 'deny':
            //             $order->status = 'failed';
            //             break;
            //         case 'expire':
            //             $order->status = 'expired';
            //             break;
            //         case 'cancel':
            //             $order->status = 'cancelled';
            //             break;
            //         default:
            //             $order->status = 'unknown';
            //             break;
            //     }
            //     $order->save();
            // }

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        // Handle successful payment redirect
        $orderId = $request->get('order_id');
        return redirect()->route('home')->with('success', 'Pembayaran berhasil! Order ID: ' . $orderId);
    }

    public function unfinish(Request $request)
    {
        // Handle unfinished payment redirect
        return redirect()->route('home')->with('warning', 'Pembayaran belum selesai');
    }

    public function error(Request $request)
    {
        // Handle payment error redirect
        return redirect()->route('home')->with('error', 'Terjadi kesalahan dalam pembayaran');
    }
}
