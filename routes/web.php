<?php

<<<<<<< HEAD
use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\User\IndexController;
=======
use App\Http\Controllers\Auth\RegisterController;
>>>>>>> a875b7d438a38c2e34c4db4d1c2a95929cdcf116

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'auth.'], function () {
<<<<<<< HEAD
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
=======
    Route::get('register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});
>>>>>>> a875b7d438a38c2e34c4db4d1c2a95929cdcf116
