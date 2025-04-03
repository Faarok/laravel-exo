<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('/property')->name('property.')->controller(PropertyController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{property}', 'show')->name('show');
    Route::post('/{property}/contact', 'contact')
        ->where([
            'property' => '[0-9]+'
        ])->name('contact');
});