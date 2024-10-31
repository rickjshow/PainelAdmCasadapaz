<?php

use App\Http\Controllers\BannersPremiosController;
use App\Http\Controllers\PremiosController;
use App\Http\Controllers\TextoPremiosController;
use Illuminate\Support\Facades\Route;

Route::get('/premios', [PremiosController::class, 'index'])->name('premios.index');
Route::post('/premios/store', [PremiosController::class, 'store'])->name('premios.store');
Route::put('/premios/{id}/edit', [PremiosController::class, 'update'])->name('premios.update');
Route::delete('/premios/{id}/destroy', [PremiosController::class, 'destroy'])->name('premios.destroy');

Route::post('/premios/banners/store', [BannersPremiosController::class, 'store'])->name('banners-premios.store');
Route::post('/imagens/{id}/remover/premios', [BannersPremiosController::class, 'remover'])->name('banners-premios.remover');

Route::post('/premios/texto-principal', [TextoPremiosController::class, 'store'])->name('texto.store');
Route::patch('/premios/texto/{id}/edit', [TextoPremiosController::class, 'update'])->name('texto.update');
