<?php

use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};

use App\Http\Controllers\User\{
    Meet\MeetController,
    Meet\Participant\ParticipantController,
    Meet\Topic\TopicController,
    Meet\Horario\HorarioController
};


use Illuminate\Support\Facades\Route;

Route::group(['as' => 'auth.'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', [RegisterController::class, 'create'])->name('register.create');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('/', [LoginController::class, 'create'])->name('login.create');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');
    });
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('login.destroy')
        ->middleware(['auth']);
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'user', 'as' => 'user.meets.'], function () {
        Route::get('meets', [MeetController::class, 'index'])
            ->name('index');
        Route::get('meets/create', [MeetController::class, 'create'])
            ->name('create');
        Route::post('meets', [MeetController::class, 'store'])
            ->name('store');
    });

    Route::group(['prefix' => 'meet', 'as' => 'horarios.'], function () {

        Route::get('{id}/horarios', [HorarioController::class, 'index'])
            ->name('index');
        // Route::get('{id}/horario/create', [HorarioController::class, 'create'])
        //     ->name('meet.create');
        Route::post('{id}/horario/store', [HorarioController::class, 'store'])
            ->name('store');
        Route::put('{id}/horario/{horario_id}/update', [HorarioController::class, 'update'])
            ->name('update');
    });

    Route::group(['as' => 'participant.'], function () {
        Route::post('meet/{id}/participant', [ParticipantController::class, 'store'])->name('store');
    });

    Route::post('{id}/meet/topic', [TopicController::class, 'store'])->name('topic.store');
});
