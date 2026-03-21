<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
Route::get('/l/{link}', [LinkController::class, 'show']);
Route::get('/photo/{path}', [ImageController::class, 'show'])
    ->name('photo.show');

Route::get('/test', function () {
    dd(Carbon::now());
});
