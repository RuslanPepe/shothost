<?php

use App\Models\LinkViews;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;
use App\Models\Link;

Route::get('/', [LinkController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
Route::get('/l/{link}', [LinkController::class, 'show']);
Route::get('/photo/{path}', [ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('photo.show');

Route::get('/test', function () {
    $link = Link::first();
//    $cur = $link->linkViews;
    $cur = $link->linkViews->increment('views');
    dd($cur);
});
