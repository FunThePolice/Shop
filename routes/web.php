<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ShopController::class, 'index'])->name('shop.index');

Route::get('/products' , [ShopController::class , 'productsAll'])->name('products.index');
Route::post('/products' , [ShopController::class , 'add'])->name('products.add');

Route::get('/cart' , [CartController::class , 'index'])->name('cart.index');
Route::post('/cart' , [CartController::class , 'buy'])->name('cart.buy');

Route::get('/orders', [OrderController::class , 'index'])->name('orders.index');
