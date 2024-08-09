<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::get('/', [ProductsController::class, 'index']);
Route::get('/cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('add_to_cart/{id}', [ProductsController::class, 'addToCart'])->name('add_to_cart');
Route::patch("update-cart", [ProductsController::class, 'update'])->name('update_cart');
Route::delete("remove-from-cart", [ProductsController::class, 'remove'])->name('remove_from_cart');

