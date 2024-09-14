<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CartController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// products
Route::get('/products', [ProductController::class,'index'])->name('products.index'); 

// wallet 
Route::get('/wallet', [WalletController::class, 'show'])->name('wallet.show')->middleware('auth');
Route::post('/wallet/add', [WalletController::class, 'addFunds'])->name('wallet.addFunds')->middleware('auth');
Route::post('/wallet/deduct', [WalletController::class, 'deductFunds'])->name('wallet.deductFunds')->middleware('auth');

// cart 
Route::middleware('auth')->group(function () {
    Route::post('/cart', [CartController::class, 'index'])->name('cart.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
 });

// order 
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
 });

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
 });

// home 
Route::get('/home', function () {
    return view('home');
 })->name('home');
