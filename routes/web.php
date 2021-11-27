<?php
//phpcs:disable

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PriorityScaleController;
use App\Http\Controllers\UserController;

Route::prefix('/')->group(function () {
    Route::get('/', [ HomeController::class, 'index' ]);
});

Route::prefix('/tasks')->group(function () {
    Route::post('/', [ TaskController::class, 'create' ]);
    Route::put('/{taskId}', [ TaskController::class, 'edit' ]);
    Route::delete('/{taskId}', [ TaskController::class, 'destroy' ]);
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
