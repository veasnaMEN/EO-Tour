<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('pages.users.addUser');
});



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
 
    // Route::get('/tours', [TourController::class, 'index'])->name('tours');
    // Route::get('/tour/{id}', [TourController::class, 'show'])->name('tour.detail');
    // Route::delete('/tour/{id}', [TourController::class, 'destroy'])->name('tour.destroy');

    Route::resource('tours', TourController::class);
    Route::resource('bookings', BookingController::class);

    
    // Route::get('/tours/new', function () {
    //     return view('pages.tours.addTour');
    // })->name('add-tour');
    // Route::post('/tours', [TourController::class, 'create']);
});