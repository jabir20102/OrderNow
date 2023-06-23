<?php

use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    // Restaurant routes
    Route::get('/restaurants/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{restaurant}/update', [RestaurantController::class, 'update'])->name('restaurants.update');

    // Photo routes
    Route::get('/restaurants/photos', [PhotoController::class, 'index'])->name('restaurant.photos.index');
    Route::post('/restaurants/photos',[PhotoController::class, 'store'])->name('restaurant.photos.store');
    Route::delete('restaurants/photos/{photo}', [PhotoController::class, 'destroy'])->name('restaurant.photos.destroy');
});

require __DIR__.'/auth.php';
