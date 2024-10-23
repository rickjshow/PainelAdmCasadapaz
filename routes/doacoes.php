<?php

use App\Http\Controllers\BannersDoacoesController;
use App\Http\Controllers\DoacoesController;
use Illuminate\Support\Facades\Route;

Route::get('/doacao', [DoacoesController::class, 'index'])->name('doacao.index');
Route::post('/doacao/store', [DoacoesController::class, 'store'])->name('doacao.store');
Route::patch('doacao/{id}/edit', [DoacoesController::class, 'update'])->name('doacao.update');

Route::post('/doacoes/banners/store', [BannersDoacoesController::class, 'store'])->name('banners-doacoes.store');
Route::post('/imagens/{id}/remover/doacoes', [BannersDoacoesController::class, 'remover'])->name('banners-doacoes.remover');
