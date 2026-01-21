<?php

use App\Http\Controllers\UserController;
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
    $user = User::find(4);

    Auth::login($user);
});


Route::put('articles/{article}',[])->middleware('permission:edit articles');
Route::delete('articles/{article}',[])->middleware('permission:delete articles');
Route::post('articles/{article}/publish',[])->middleware('permission:publish articles');
Route::post('articles/{article}/un-publish',[])->middleware('permission:unpublish articles');
Route::get('articles',[])->middleware('permission:view articles');
Route::get('articles/{article}',[])->middleware('permission:view articles');