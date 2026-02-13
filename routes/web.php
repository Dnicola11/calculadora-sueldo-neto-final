<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

// Rutas de autenticación
Route::controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->name('logout');
    });

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Ruta principal - redirige al índice de trabajadores
    Route::get('/', [WorkerController::class, 'index'])->name('home');
    
    // Rutas de trabajadores
    Route::resource('workers', WorkerController::class)->except(['create', 'edit']);
});
