<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function() {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'connect')->name('connect');
    Route::get('/logout', 'logout')->name('logout');
});