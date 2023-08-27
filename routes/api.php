<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', [CustomerController::class, 'register']);
Route::post('login', [CustomerController::class, 'login']);


Route::apiResource('restaurants', RestaurantController::class);
Route::get('dishes', [RestaurantController::class, 'best_dishes']);
Route::get('restaurants/{id}/dishes', [RestaurantController::class, 'dishes']);

Route::apiResource('customers', CustomerController::class);

Route::post('orders', [OrderController::class, 'store']);
Route::post('order-items', [OrderItemController::class, 'store']);
Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::delete('orders/{order}', [OrderController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    //  http://127.0.0.1:8000/api/restaurants  
    //  http://127.0.0.1:8000/api/restaurants/1
    //  http://127.0.0.1:8000/api/restaurants/1/dishes
});
