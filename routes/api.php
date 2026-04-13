<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'getUser']);

Route::post('/download/image/all', [ImageController::class, 'downloadImagesAll'])->name('download.image.all');
Route::post('/download/image', [ImageController::class, 'downloadImage'])->name('download.image');

//Route::get('/', [LinkController::class, 'index']);
Route::post('/createLink', [LinkController::class, 'store']);
//Route::get('/l/{link}', [LinkController::class, 'show']);
//Route::get('/photo/{path}', [ImageController::class, 'show'])
//    ->where('path', '.*')
//    ->name('photo.show');

//Route::get('/link-password/{id}', [PasswordController::class, 'passwordIndex'])->name('password.index');
Route::post('/link-password/check', [PasswordController::class, 'passwordCheck'])->name('password.check');

//Route::group(['middleware' => 'auth'], function () {});

Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/login', [UserController::class, 'login'])->name('user.login');

