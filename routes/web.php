<?php
//phpcs:disable

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PriorityScaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskTypeController;

Route::prefix('/')->group(function () {
    Route::get('/', [ HomeController::class, 'index' ]);
    Route::get('/login', [ HomeController::class, 'login' ]);
    Route::get('/register', [ HomeController::class, 'register' ]);
});

Route::prefix('/tasks')->group(function () {
    Route::post('/', [ TaskController::class, 'create' ]);
    Route::put('/{taskId}', [ TaskController::class, 'edit' ]);
    Route::delete('/{taskId}', [ TaskController::class, 'destroy' ]);
});

Route::prefix('/task-type')->group(function () {
    Route::post('/', [ TaskTypeController::class, 'create' ]);
    Route::put('/{taskTypeId}', [ TaskTypeController::class, 'edit' ]);
    Route::delete('/{taskTypeId}', [ TaskTypeController::class, 'destroy' ]);
});

Route::prefix('/priorities')->group(function(){
    Route::post('/', [ PriorityScaleController::class, 'create' ]);
    Route::put('/{prioId}', [ PriorityScaleController::class, 'edit' ]);
    Route::delete('/{prioId}', [ PriorityScaleController::class, 'delete' ]);
});

Route::prefix('/users')->group(function(){
    Route::post('/', [ UserController::class, 'create' ]);
    Route::put('/{userId}', [ UserController::class, 'edit' ]);
    Route::delete('/{userId}', [ UserController::class, 'delete' ]);
});
