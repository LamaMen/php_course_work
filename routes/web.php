<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowplacesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');
Route::view('/not-permitted', 'other.not-permitted')->name('not-permitted');

Route::view('/sing_in', 'auth.sing_in');
Route::view('/sing_up', 'auth.sing_up');
Route::post('/sing_in', [AuthController::class, 'singIn']);
Route::post('/sing_up', [AuthController::class, 'singUp']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::view('/places', 'places.places');

    Route::get('/excursions/{page?}', [ExcursionController::class, 'allExcursions']);
    Route::get('/excursion/{id}', [ExcursionController::class, 'excursion']);

    Route::get('/showplaces/{page?}', [ShowplacesController::class, 'allShowplaces']);
    Route::get('/showplace/{id}', [ShowplacesController::class, 'showplace']);

    Route::post('/comments/create', [CommentController::class, 'create']);

    Route::get('/user/{id}', [UserController::class, 'user']);
});

Route::middleware(['user'])->group(function () {
    Route::view('/orders', 'orders.order');
});

Route::middleware(['instructor'])->group(function () {
    Route::view('/places', 'place.places');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin', 'admin.admin')->name('admin');
});
