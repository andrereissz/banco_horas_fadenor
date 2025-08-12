<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:fundacao')->group(function () {
    Route::get('/login', function () {
        return view('fundacao.auth.login');
    })->name('login');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
});

Route::middleware('auth:fundacao')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/solicitar-bolsa', function () {
        return view('fundacao.solicitar-bolsa');
    })->name('solicitar-bolsa');

    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::get('/profile', function () {
        return view('fundacao.profile.edit');
    })->name('profile.edit');
});
