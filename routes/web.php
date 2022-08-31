<?php

use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\Pool\{
    DataController,
    PoolController,
    TopicController
};
use App\Http\Controllers\User\{
    IndexController,
    Meet\MeetController
};
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

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('index', [IndexController::class, 'index'])
        ->name('index');

    Route::get('meets', [MeetController::class, 'index'])
        ->name('meets.index');
    Route::get('meets/create', [MeetController::class, 'create'])
        ->name('meets.create');
    Route::post('meets', [MeetController::class, 'store'])
        ->name('meets.store');
});

Route::group(['prefix' => 'pool', 'as' => 'pool.'], function () {
    Route::get('index', [PoolController::class, 'index'])->name('index');
    Route::post('',[PoolController::class, 'store'])->name('store');
    Route::post('data', [DataController::class, 'store'])->name('dates.store');
    Route::post('topics', [TopicController::class, 'store'])->name('topics.store');
});
