<?php

use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DishPhotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    //  Dashboard
    Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('dashboard');
    // Restaurant routes
    Route::get('/restaurants/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{restaurant}/update', [RestaurantController::class, 'update'])->name('restaurants.update');

    // Photo routes
    Route::get('/restaurants/photos', [PhotoController::class, 'index'])->name('restaurant.photos.index');
    Route::post('/restaurants/photos',[PhotoController::class, 'store'])->name('restaurant.photos.store');
    Route::delete('restaurants/photos/{photo}', [PhotoController::class, 'destroy'])->name('restaurant.photos.destroy');
    
    //   Dish 
    Route::get('restaurant/dishes', [DishController::class, 'index'])->name('dishes.index');
    Route::get('restaurant/dishes/create', [DishController::class, 'create'])->name('dishes.create');
    Route::post('restaurant/dishes/store', [DishController::class, 'store'])->name('dishes.store');
    
});
Route::get('commands/{command}', function($command){
    Artisan::call($command);
    return Artisan::output();
   });
    

require __DIR__.'/auth.php';
