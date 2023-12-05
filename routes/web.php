<?php

use App\Models\CarBiding;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarBidingController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\MyDealershipController;
use App\Http\Controllers\MyBidApplicationController;

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
// Home route redirects to cars.index
// Home route redirects to cars.index
Route::get('', fn () => to_route('cars.index'));

// Car resource routes for index and show actions
Route::resource('cars', CarController::class)->only(['index', 'show']);

// Login route
Route::get('login', fn() => to_route('auth.create'))->name('login');

// Auth resource routes for create, store, and register actions
Route::resource('auth', AuthController::class)->only(['create', 'store', 'register']);
Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('register', [AuthController::class, 'registerPost'])->name('auth.registerPost');

// Logout route
Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');

// Auth destroy route for logout
Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

Route::middleware('auth')->group(function () {
    Route::resource('car.biding', CarBidingController::class)
        ->only(['create', 'store']);
    Route::resource('my-car-bid', MyBidApplicationController::class)
        ->only(['index', 'destroy']);
    Route::resource('dealership', DealershipController::class)
        ->only(['create', 'store']);
    Route::middleware('dealership')
        ->resource('my-cars', MyDealershipController::class);
});