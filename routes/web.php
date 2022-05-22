<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

Route::view('/sing_in', 'auth.sing_in');
Route::view('/sing_up', 'auth.sing_up');
Route::post('/sing_in', [AuthController::class, 'singIn']);
Route::post('/sing_up', [AuthController::class, 'singUp']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::view('/places', 'places.places');
    Route::get('/excursions/{page?}', [ExcursionController::class, 'allExcursions']);
});
