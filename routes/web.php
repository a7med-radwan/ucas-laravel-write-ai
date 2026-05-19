<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');


Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
], function () {
    Route::resource('posts', PostController::class);
});

Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
], function () {
    Route::resource('categories', CategoryController::class);
});
