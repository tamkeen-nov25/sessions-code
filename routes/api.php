<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('users', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'index'])->middleware(TestMiddleware::class . ':alissar');
Route::get('users/{user}', [UserController::class, 'show']);

Route::post('users/{user}/attach-user-with-posts', [UserController::class, 'attachUserWithPosts']);

Route::get('users/{user}/posts', [UserController::class, 'getUserPosts']);

Route::post('users/{user}/detach-posts', [UserController::class, 'detachUserWithPosts']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::delete('logout', [AuthController::class, 'logout'])->middleware('auth:api');