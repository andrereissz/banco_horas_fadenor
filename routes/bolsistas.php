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
    Route::get('/registrar/{bolsa_token}', function ($bolsa_token) {
        return view('bolsistas.auth.check-cpf', ['bolsa_token' => $bolsa_token]);
    })->name('registrar');
    Route::get('/cadastrar/{bolsa_token}', function ($bolsa_token) {
        return view('bolsistas.cadastro', ['bolsa_token' => $bolsa_token]);
    })->name('cadastrar');
});

Route::middleware('auth:bolsistas')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::get('/confirmar/{bolsa_token}', function ($bolsa_token) {
        return view('bolsistas.confirmar', ['bolsa_token' => $bolsa_token]);
    })->name('confirmar')->middleware(ValidToken::class);
});
