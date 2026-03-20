<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;

Route::get('/', [ImageController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
Route::get('/q/{link}', [LinkController::class, 'index']);
Route::get('/photo/{path}', [LinkController::class, 'show'])
    ->name('photo.show');

Route::get('/test', function () {
    dd(Carbon::now());
});
