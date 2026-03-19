<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;

Route::get('/', [ImageController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'createLink']);
Route::post('/upload', [ImageController::class, 'upload']);

Route::get('/test', function () {
    dd(microtime(true));
});
