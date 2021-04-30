<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->group(function () {
    Route::prefix('seller')->group(function () {
        Route::get('/', [SellerController::class, 'list'])->name('seller.list');
        Route::post('/', [SellerController::class, 'store'])->name('seller.store');
    });

    Route::prefix('sale')->group(function () {
        Route::get('/seller/{sellerId}', [SaleController::class, 'getSalesBySellerId'])->name('sale.getSalesBySellerId');
        Route::post('/', [SaleController::class, 'store'])->name('sale.store');
    });
});
