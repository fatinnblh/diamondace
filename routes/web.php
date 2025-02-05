<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::get('/service', function () {
    return view('service');
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

// Dashboard Route
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

// FAQ Route
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');

// About Page Route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order_id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{order_id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update.status');
    Route::post('/admin/orders/{order_id}/order-status', [AdminOrderController::class, 'updateOrderStatus'])->name('admin.orders.update.order.status');
});

// Admin Authentication Routes
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/auth/google', [App\Http\Controllers\Auth\AdminGoogleAuthController::class, 'redirectToGoogle'])
    ->name('admin.google.login');

Route::get('/admin/auth/google/callback', [App\Http\Controllers\Auth\AdminGoogleAuthController::class, 'handleGoogleCallback'])
    ->name('admin.google.callback');

// Google Authentication Routes
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/auth/google/disconnect', [App\Http\Controllers\Auth\GoogleAuthController::class, 'disconnectGoogleAccount'])
    ->name('google.disconnect')
    ->middleware('auth');

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Removed the old Google authentication routes
