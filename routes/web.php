<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // ou redirecione para fundacao.login
})->name('login');

Route::prefix('fundacao')->name('fundacao.')->group(function () {
    require __DIR__.'/fundacao.php';
});

Route::prefix('bolsistas')->name('bolsistas.')->group(function () {
    require __DIR__.'/bolsistas.php';
});
