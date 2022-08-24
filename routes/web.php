<?php

use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\User\IndexController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'auth.'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', [RegisterController::class, 'create'])->name('register.create');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('login', [LoginController::class, 'create'])->name('login.create');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');
    });
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('login.destroy')
        ->middleware(['auth']);
});

Route::get('index', [IndexController::class, 'index'])
    ->name('user.index')
    ->middleware('auth');
