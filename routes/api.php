<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BiteshipController;
use App\Http\Controllers\DataCenterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Payment Routes
Route::prefix('orders')->group(function () {
    Route::post('/cod', [PaymentController::class, 'handleCOD']);
    Route::post('/midtrans', [PaymentController::class, 'handleMidtrans']);
});

// Biteship Routes
Route::prefix('biteship')->group(function () {
    Route::post('/instant-rates', [BiteshipController::class, 'getInstantRates']);
    Route::get('/couriers', [BiteshipController::class, 'getCouriers']);
    Route::get('/test', [BiteshipController::class, 'testConnection']);
});

// Notification Routes
Route::post('/webhook/notifications', [DataCenterController::class, 'notification']);
Route::post('/notifications/clear', [DataCenterController::class, 'clearNotifications']);
