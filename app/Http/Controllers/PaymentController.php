<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey      = config('midtrans.server_key');
        Config::$clientKey      = config('midtrans.client_key');
        Config::$isProduction   = config('midtrans.is_production');
        Config::$isSanitized    = config('midtrans.is_sanitized');
        Config::$is3ds          = config('midtrans.is_3ds');
    }

    public function handleCOD(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName'     => 'required|string|max:255',
            'lastName'      => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string',
            'province'      => 'required|string',
            'city'          => 'required|string',
            'postalCode'    => 'required|string|max:10',
            'orderNotes'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validation failed',
                'errors'    => $validator->errors()
            ], 422);
        }

        try {
            // Here you would typically save the order to database
            // For now, we'll just return success

            // You can create an Order model and save the data
            // $order = Order::create([
            //     'customer_name' => $request->firstName . ' ' . $request->lastName,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'province' => $request->province,
            //     'city' => $request->city,
            //     'postal_code' => $request->postalCode,
            //     'notes' => $request->orderNotes,
            //     'payment_method' => 'cod',
            //     'status' => 'pending',
            //     'total_amount' => 315000, // You should calculate this from cart
            // ]);

            return response()->json([
                'success'   => true,
                'message'   => 'Order created successfully',
                'order_id'  => 'COD-' . time() // Generate proper order ID
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleMidtrans(Request $request)
    {
        try {
            // Get data from JSON request
            $data = $request->all();

            // Generate unique order ID
            $orderId = 'SIGMA-' . time() . '-' . rand(100, 999);

            // Prepare transaction details
            $transaction_details = [
                'order_id' => $orderId,
                'gross_amount' => 315000, // You should calculate this from cart
            ];

            // Prepare customer details
            $customer_details = [
                'first_name' => $data['customer_details']['first_name'] ?? 'Customer',
                'last_name'  => $data['customer_details']['last_name'] ?? '',
                'email'      => $data['customer_details']['email'] ?? '',
                'phone'      => $data['customer_details']['phone'] ?? '',
            ];

            // Prepare item details
            $item_details = $data['item_details'] ?? [
                [
                    'id' => 'ETAWALIN-001',
                    'price' => 185000,
                    'quantity' => 1,
                    'name' => 'Etawalin Premium'
                ],
                [
                    'id' => 'VITAMIN-001',
                    'price' => 165000,
                    'quantity' => 1,
                    'name' => 'Vitamin Complete'
                ]
            ];

            // Prepare transaction data
            $transaction_data = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
            ];

            // Jika ada metode pembayaran yang dipilih, gunakan hanya metode tersebut
            // Kecuali QRIS - biarkan semua metode muncul agar user bisa pilih
            if (isset($data['enabled_payments']) && is_array($data['enabled_payments']) && count($data['enabled_payments']) === 1) {
                // Jika bukan QRIS, gunakan metode terbatas
                if (!in_array('qris', $data['enabled_payments'])) {
                    $transaction_data['enabled_payments'] = $data['enabled_payments'];
                }
                // Jika QRIS, biarkan semua metode muncul (jangan set enabled_payments)
            }

            // Add redirect URLs if provided
            if (isset($data['finish_redirect_url'])) {
                $transaction_data['finish_redirect_url'] = $data['finish_redirect_url'];
            }
            if (isset($data['unfinish_redirect_url'])) {
                $transaction_data['unfinish_redirect_url'] = $data['unfinish_redirect_url'];
            }
            if (isset($data['error_redirect_url'])) {
                $transaction_data['error_redirect_url'] = $data['error_redirect_url'];
            }

            // Create Snap token
            $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);

            // Log the transaction data for debugging
            Log::info('Midtrans Transaction Data:', $transaction_data);
            Log::info('Midtrans Snap Token:', ['token' => $snapToken]);
            Log::info('Selected Payment Method:', ['method' => $data['enabled_payments'] ?? 'all']);

            // Determine message based on method
            $selectedMethod = $data['enabled_payments'][0] ?? 'all';
            if ($selectedMethod === 'qris') {
                $message = 'QRIS selected - All payment methods will be shown for user to choose';
            } else {
                $message = isset($data['enabled_payments']) ? 'Payment method restricted to: ' . implode(', ', $data['enabled_payments']) : 'All available payment methods will be shown';
            }

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'selected_method' => $selectedMethod,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getEnabledPayments($preferredMethod = null)
    {
        $allPayments = [
            'credit_card',
            'bca_va',
            'bni_va',
            'bri_va',
            'mandiri_va',
            'gopay',
            'shopeepay',
            'ovo',
            'dana',
            'qris'
        ];

        if ($preferredMethod) {
            switch ($preferredMethod) {
                case 'bca':
                    return ['bca_va'];
                case 'mandiri':
                    return ['mandiri_va'];
                case 'bni':
                    return ['bni_va'];
                case 'bri':
                    return ['bri_va'];
                case 'ovo':
                    return ['ovo'];
                case 'dana':
                    return ['dana'];
                case 'gopay':
                    return ['gopay'];
                case 'shopeepay':
                    return ['shopeepay'];
                case 'qris':
                    // QRIS: Kembalikan semua metode agar user bisa pilih
                    return $allPayments;
                case 'creditcard':
                    return ['credit_card'];
                default:
                    return $allPayments;
            }
        }

        return $allPayments;
    }

}
