<?php

use App\Http\Controllers\AdminDashboard\RoleController;
use App\Http\Controllers\AdminDashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureUserType;
use Illuminate\Support\Facades\Route;



Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name('posts.show');
Route::get('/', HomeController::class)->name('home');
Route::get('/u/{username}', function () { })
    ->name('users.profile');

Route::post('users/{user}/follow', [FollowController::class, 'store'])
    ->name('users.follow')
    ->middleware(['auth:web']);
Route::delete('users/{user}/unfollow', [FollowController::class, 'destroy'])
    ->name('users.unfollow')
    ->middleware(['auth:web']);


Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
    'middleware' => ['auth:web', 'verified', 'active'],
], function () {
    Route::put('posts/{post}/restore', [PostController::class, 'restore'])
        ->name('posts.restore');
    Route::delete('posts/{post}/force', [PostController::class, 'forceDelete'])
        ->name('posts.force-delete');
    Route::resource('posts', PostController::class);

    Route::resource('categories', CategoryController::class)->middleware('type:super-admin,admin');

    Route::group([
        'as' => 'notifications.',
        'prefix' => 'notifications/',
        'controller' => NotificationController::class,
    ], function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/read-all', 'markAllAsRead')->name('mark-all-read');
        Route::patch('/{id}/read', 'read')->name('read');
        Route::patch('/{id}/unread', 'unread')->name('unread');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin/',
    'middleware' => ['auth', 'active'],
], function () {
    Route::resource('roles', RoleController::class)->except(['show'])->middleware('type:super-admin');
    Route::resource('users', UserController::class);
});