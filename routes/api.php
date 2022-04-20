<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductApiController;
use App\Http\Controllers\api\CategoryApiController;
use App\Http\Controllers\api\MaterialApiController;
use App\Http\Controllers\api\VendorApiController;
use App\Http\Controllers\api\SaleApiController;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ExpenseApiController;
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
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('sales')->group(function () {
        Route::get('', [SaleApiController::class, 'index']);
        Route::post('checkout', [SaleApiController::class, 'store']);
    });
    Route::prefix('users')->group(function () {
        Route::post('logout', [AuthApiController::class, 'logout']);
    });
});
Route::prefix('products')->group(function () {
    Route::get('', [ProductApiController::class, 'index']);
    Route::post('', [ProductApiController::class, 'store']);
});
Route::prefix('categories')->group(function () {
    Route::get('', [CategoryApiController::class, 'index']);
});
Route::prefix('materials')->group(function () {
    Route::get('', [MaterialApiController::class, 'index']);
});
Route::prefix('vendors')->group(function () {
    Route::get('', [VendorApiController::class, 'index']);
});
Route::prefix('expenses')->group(function () {
    Route::get('', [ExpenseApiController::class, 'index']);
    Route::post('', [ExpenseApiController::class, 'store']);
});


Route::post('users/login', [AuthApiController::class, 'login']);
