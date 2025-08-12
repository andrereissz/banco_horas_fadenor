<?php

use App\Http\Controllers\LogoutController;
use App\Http\Middleware\ValidToken;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:bolsistas')->group(function () {
    Route::get('/login', function () {
        return view('bolsistas.auth.login');
    })->name('login');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
});

Route::middleware(ValidToken::class)->group(function () {
    Route::get('/registrar/{$token}', function ($token) {
        return view('bolsistas.registrar', ['token' => $token]);
    })->name('registrar');
});

Route::middleware('auth:bolsistas')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
});
