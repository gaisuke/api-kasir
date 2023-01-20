<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;

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
Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'product'], function () {
                Route::get('/', [ProductController::class, 'index']);
                Route::get('/{slug}', [ProductController::class, 'show']);
            });

            Route::group(['prefix' => 'cart'], function () {
                Route::get('/', [CartController::class, 'index']);
                Route::post('/add-to-cart', [CartController::class, 'addToCart']);
                Route::post('/delete-item', [CartController::class, 'deleteItem']);
                Route::post('/checkout', [CartController::class, 'checkout']);
            });

            Route::group(['prefix' => 'order'], function () {
                Route::get('/', [OrderController::class, 'index']);
                Route::get('/{invoice}', [OrderController::class, 'show']);
            });
        });
    });
});
