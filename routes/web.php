<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Models\Link;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/download/image/all', [ImageController::class, 'downloadImagesAll'])->name('download.image.all');
Route::post('/download/image', [ImageController::class, 'downloadImage'])->name('download.image');

Route::get('/', [LinkController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
Route::get('/l/{link}', [LinkController::class, 'show']);
Route::get('/photo/{path}', [ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('photo.show');

Route::get('/link-password/{id}', [PasswordController::class, 'passwordIndex'])->name('password.index');
Route::post('/link-password/check', [PasswordController::class, 'passwordCheck'])->name('password.check');

Route::get('/test', function () {
//    session(['id' => '123']);
    $session = session();
    dd($session->all());
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
