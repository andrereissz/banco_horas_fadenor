<?php

use App\Http\Controllers\BolsaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/solicitar', [BolsaController::class, 'solicitar'])->name('bolsa.solicitar');
    Route::get('/registrar/{token}', [BolsaController::class, 'registrar'])->name('bolsa.registrar');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bolsas', BolsaController::class)->middleware('auth');

require __DIR__.'/auth.php';
