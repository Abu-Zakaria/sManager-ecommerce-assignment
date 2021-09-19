<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
	Route::post('/add-to-cart/{id}', [CartController::class, 'add']);

	Route::get('/cart', [CartController::class, 'index']);
	Route::patch('/cart', [CartController::class, 'update']);
	Route::get('/clear-cart', [CartController::class, 'clearCart']);

	Route::get('/checkout', [CheckoutController::class, 'index']);
	Route::post('/checkout', [CheckoutController::class, 'store']);

	Route::get('/orders', [OrderController::class, 'index']);
});