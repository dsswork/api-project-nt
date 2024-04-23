<?php

use App\Http\Controllers\Api as Api;
use App\Http\Controllers\Auth as Auth;
use Illuminate\Support\Facades\Route;

/** Common  */
Route::get('packages', [Api\Common\PackageController::class, 'index']);
Route::get('posts', [Api\Common\PostController::class, 'index']);
Route::get('authors', [Api\Common\AuthorController::class, 'index']);

/** Auth */
Route::post('register', [Auth\RegisterController::class, 'store']);
Route::post('login', [Auth\LoginController::class, 'store']);

/** User Posts */
Route::put('user/posts/activate/{post}', [Api\User\PostController::class, 'activate'])
    ->middleware('auth:sanctum');
Route::apiResource('user/posts', Api\User\PostController::class)
    ->middleware('auth:sanctum');

/** User Packages */
Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'user/packages'], function () {
    Route::get('/', [Api\User\PackageController::class, 'index']);
    Route::post('/buy/{package}', [Api\User\PackageController::class, 'buy']);
});

/** Admin Packages */
Route::group(['middleware' => ['auth:sanctum', 'admin'], 'prefix' => 'admin/packages'], function () {
    Route::put('activate/{package}', [Api\Admin\PackageController::class, 'activate']);
    Route::get('/', [Api\Admin\PackageController::class, 'index']);
    Route::post('/', [Api\Admin\PackageController::class, 'store']);
});
