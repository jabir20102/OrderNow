<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\RestaurantController;

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


Route::post('register', [CustomerController::class,'register']);
Route::post('login', [CustomerController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class);
    Route::get('restaurants/{id}/dishes', [RestaurantController::class,'dishes']);
    //  http://127.0.0.1:8000/api/restaurants  
    //  http://127.0.0.1:8000/api/restaurants/1
    //  http://127.0.0.1:8000/api/restaurants/1/dishes
    Route::apiResource('customers', CustomerController::class);

});

