<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Task routes
    Route::resource('tasks', TaskController::class);
});

// Home route
Route::get('/', function () {
    return view('welcome');
});
