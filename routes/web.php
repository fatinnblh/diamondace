<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/page-count', [OrderController::class, 'getPageCount'])->name('orders.page_count');
Route::get('/orders/summary/{id}', [OrderController::class, 'summary'])->name('orders.summary');
Route::get('/delivery-address/{order_id}', [OrderController::class, 'showDeliveryAddressForm'])->name('delivery.address.form');
Route::get('/pickup-address/{order_id}', [OrderController::class, 'showPickupAddressForm'])->name('pickup.address.form');
Route::post('/payment-method/{order_id}', [OrderController::class, 'handlePaymentMethod'])->name('payment.method');
Route::post('/orders/{order_id}/upload-receipt', [OrderController::class, 'uploadReceipt'])->name('orders.upload.receipt');
Route::get('/orders/{order_id}/tracking', [OrderController::class, 'showTrackingProgress'])->name('orders.tracking');
Route::post('/delivery-address/{order_id}', [OrderController::class, 'handleDeliveryAddress'])->name('delivery.address.submit');
Route::post('/pickup-address/{order_id}', [OrderController::class, 'handlePickupAddress'])->name('pickup.address.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
    Route::get('/admin/orders/{order_id}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::post('/admin/orders/{order_id}/status', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.update.status');
});