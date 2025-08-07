<?php

use App\Http\Middleware\ValidToken;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:bolsistas')->group(function () {
    Route::get('/login', function () {
        return view('bolsistas.auth.login');
    })->name('login');
});

Route::middleware(ValidToken::class)->group(function () {
    Route::get('/registrar/{$token}', function ($token) {
        return view('bolsistas.registrar', ['token' => $token]);
    })->name('registrar');
});
