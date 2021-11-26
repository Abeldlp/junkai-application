<?php
//phpcs:disable

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return redirect('/clients');
});

Route::prefix('/')->group(function () {
    Route::get('/', [ HomeController::class, 'index' ]);
});


Route::prefix('tasks')->group(function () {
    Route::post('/', [ TaskController::class, 'create']);
});

