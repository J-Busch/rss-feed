<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('login');

Route::controller(FeedController::class)->group(function () {
    Route::get('/feed', 'index')->middleware('auth');
    Route::post('/feed', 'store')->middleware('auth');
    Route::delete('/feed', 'destroy')->middleware('auth');
    Route::get('/feed/list', 'list')->middleware('auth');
});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
