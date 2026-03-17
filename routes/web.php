<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', [ImageController::class, 'index']);
Route::post('/upload', [ImageController::class, 'upload']);

Route::get('/test', function () {
    dd(microtime(true));
});
