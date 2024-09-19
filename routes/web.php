<?php

use App\Http\Controllers\BannersController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\OutrosController;
use App\Http\Controllers\TextosController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/banner', [BannersController::class, 'index'])->name('banner.index');
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::get('/bazar', [BazarController::class, 'index'])->name('bazar.index');
Route::get('/textos', [TextosController::class, 'index'])->name('textos.index');