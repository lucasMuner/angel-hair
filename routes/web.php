<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::middleware('auth.custom:guest')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth.custom:auth')->group(function () {
    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/appointments', [MainController::class, 'appointments'])->name('appointments');
    Route::get('/clients', [MainController::class, 'clients'])->name('clients');
    Route::get('/employees', [MainController::class, 'employees'])->name('employees');
    Route::get('/services', [MainController::class, 'services'])->name('services');
});
