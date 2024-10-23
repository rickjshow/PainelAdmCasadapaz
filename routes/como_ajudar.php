<?php

use App\Http\Controllers\BannersComoAjudarController;
use App\Http\Controllers\ComoAjudarController;
use Illuminate\Support\Facades\Route;

Route::get('/como-ajudar', [ComoAjudarController::class, 'index'])->name('como-ajudar.index');

Route::post('/como-ajudar/banners/store', [BannersComoAjudarController::class, 'store'])->name('banners-comoajudar.store');
Route::post('/imagens/{id}/remover/como-ajudar', [BannersComoAjudarController::class, 'remover'])->name('banners-comoajudar.remover');
