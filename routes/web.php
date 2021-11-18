<?php
//phpcs:disable

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/clients');
});

Route::prefix('/')->group(function () {
    Route::get('/', [ HomeController::class, 'index' ]);
});

