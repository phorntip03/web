<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\FlowerShopController; // เปลี่ยนเป็น FlowerShopController
use App\Http\Controllers\AuthController;

// Routes for FlowerShopController
Route::get('/flowerShops', [FlowerShopController::class, 'index']);

Route::post('/flowerShops', [FlowerShopController::class, 'store']);

Route::get('/flowerShops/{id}', [FlowerShopController::class, 'show']);

Route::put('/flowerShops/{id}', [FlowerShopController::class, 'update']);

Route::delete('/flowerShops/{id}', [FlowerShopController::class, 'destroy']);

// Authentication Routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);

// Routes within the auth:sanctum middleware
Route::group(['middleware' => ['auth:sanctum']],
    function() {
        Route::resource('flowerShop', FlowerShopController::class); // เปลี่ยนเป็น flowerShop

        Route::post('logout',[AuthController::class,'logout']);
    }
);
