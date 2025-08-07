<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;

Route::middleware('guest:fundacao')->group(function () {
    Route::get('/login', function(){
        return view('fundacao.auth.login');
    })->name('login');
});

Route::middleware('auth:fundacao')->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/solicitar-bolsa', function () { return view('fundacao.solicitar-bolsa'); })->name('solicitar-bolsa');

    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::get('/profile', function() { return view('fundacao.profile.edit'); })->name('profile.edit');
});
