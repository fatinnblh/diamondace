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
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/page-count', [OrderController::class, 'getPageCount'])->name('orders.page_count');
Route::get('/orders/summary/{id}', [OrderController::class, 'summary'])->name('orders.summary');
Route::get('/delivery-address/{order_id}', [OrderController::class, 'showDeliveryAddressForm'])->name('delivery.address.form');
Route::get('/pickup-address/{order_id}', [OrderController::class, 'showPickupAddressForm'])->name('pickup.address.form');
Route::post('/payment-method/{order_id}', [OrderController::class, 'handlePaymentMethod'])->name('payment.method');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');