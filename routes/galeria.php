<?php

use App\Http\Controllers\BannersGaleriaController;
use App\Http\Controllers\GaleriaController;
use Illuminate\Support\Facades\Route;

Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');

Route::post('/galeria/banners/store', [BannersGaleriaController::class, 'store'])->name('banners-galeria.store');
Route::post('/imagens/{id}/remover/galeria', [BannersGaleriaController::class, 'remover'])->name('banners-galeria.remover');
