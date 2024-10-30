<?php

use App\Http\Controllers\BannersPremiosController;
use App\Http\Controllers\PremiosController;
use App\Http\Controllers\TextoPremiosController;
use Illuminate\Support\Facades\Route;

Route::get('/premios', [PremiosController::class, 'index'])->name('premios.index');

Route::post('/premios/banners/store', [BannersPremiosController::class, 'store'])->name('banners-premios.store');
Route::post('/imagens/{id}/remover/premios', [BannersPremiosController::class, 'remover'])->name('banners-premios.remover');

Route::post('/premios/texto-principal', [TextoPremiosController::class, 'store'])->name('texto.store');
Route::patch('/premios/texto/{id}/edit', [TextoPremiosController::class, 'update'])->name('texto.update');
