<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::middleware('auth:sanctum')->post('/add-funds', [UserController::class, 'addFunds']);

// product
Route::apiResource('products', ProductController::class); 

// wallet
Route::get('/users/{userId}/wallet', [WalletController::class, 'show']);
Route::post('/users/{userId}/wallet/add', [WalletController::class, 'addFunds']);
Route::post('/users/{userId}/wallet/deduct', [WalletController::class, 'deductFunds']);


// cart
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove']);
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
 });

// order 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('orders', OrderController::class);
 });