<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PropertyController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function() {
    Route::prefix('/option')->controller(OptionController::class)->name('option.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'create')->name('create');
        Route::post('/new', 'store')->name('store');
        Route::delete('/delete/{option}', 'destroy')->name('destroy');
        Route::get('/edit/{option}', 'edit')
            ->where([
                'option' => '[0-9]+'
            ])
            ->name('edit');
        Route::patch('/edit/{option}', 'update')
            ->where([
                'option' => '[0-9]+'
            ])
            ->name('update');
    });

    // Simplifiable avec Route::resource('property', AdminController::class), qui créé les routes CRUD
    // ajouter ->except() pour définir les routes exclues par ::ressource
    Route::prefix('/property')->name('property.')->controller(AdminController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'create')->name('create');
        Route::post('/new', 'store')->name('store');
        Route::delete('/delete/{property}', 'destroy')
            ->where([
                'property' => '[0-9]+'
            ])
            ->name('destroy');
        Route::get('/edit/{property}', 'edit')
            ->where([
                'property' => '[0-9]+'
            ])
            ->name('edit');
        Route::patch('/edit/{property}', 'update')
            ->where([
                'property' => '[0-9]+'
            ])
            ->name('update');
    });

    Route::prefix('/image')->name('image.')->controller(ImageController::class)->group(function() {
        Route::delete('/delete/{image}', 'destroy')
            ->where([
                'image' => '[0-9]+'
            ])
            ->name('destroy');
    });
});

Route::prefix('/property')->name('property.')->controller(PropertyController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{property}', 'show')->name('show');
    Route::post('/{property}/contact', 'contact')
        ->where([
            'property' => '[0-9]+'
        ])->name('contact');
});

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function() {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'connect')->name('connect');
    Route::get('/logout', 'logout')->name('logout');
});