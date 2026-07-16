<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware('guest')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [MainController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register-store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::get('/appointments', [MainController::class, 'appointments'])->name('appointments');
    Route::get('/roles', [MainController::class, 'roles'])->name('roles');
    Route::get('/clients', [MainController::class, 'clients'])->name('clients');
    Route::get('/employees', [MainController::class, 'employees'])->name('employees');
    Route::get('/services', [MainController::class, 'services'])->name('services');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
