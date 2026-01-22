<?php

use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');



Route::get('/users/edit/{user}', [UserController::class, 'edit'])
    ->name('users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');

Route::delete('users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');


Route::get('home', [UserController::class, 'home'])
    ->middleware(['auth', 'permission:publish articles']);

Route::get('locale/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->back();
})->name('locale');

Route::get('login', function () {
    auth('admin')->attempt([
        'email' => "admin1@gmail.com",
        'password' => 12345
    ]);

    $admin = auth('admin')->user();

    auth('admin')->login($admin);




})->middleware('auth:admin');


Route::put('articles/{article}', [])->middleware('permission:edit articles');
Route::delete('articles/{article}', [])->middleware('permission:delete articles');
Route::post('articles/{article}/publish', [])->middleware('permission:publish articles');
Route::post('articles/{article}/un-publish', [])->middleware('permission:unpublish articles');
