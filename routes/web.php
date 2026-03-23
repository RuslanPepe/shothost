<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Models\Link;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/download/image/all', [ImageController::class, 'downloadImageAll'])->name('download.image.all');
Route::post('/download/image', [ImageController::class, 'downloadImage'])->name('download.image');

Route::get('/', [LinkController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
Route::get('/l/{link}', [LinkController::class, 'show']);
Route::get('/photo/{path}', [ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('photo.show');

Route::get('/test', function () {
    $link = Link::first();
    $cur = $link->linkViews->increment('views');
    dd($cur);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
