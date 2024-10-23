<?php

use App\Http\Controllers\BannersBazarController;
use App\Http\Controllers\BazarController;
use Illuminate\Support\Facades\Route;

Route::get('/bazar', [BazarController::class, 'index'])->name('bazar.index');

Route::post('/bazar/banners/store', [BannersBazarController::class, 'store'])->name('banners-bazar.store');
Route::post('/imagens/{id}/remover/bazar', [BannersBazarController::class, 'remover'])->name('banners-bazar.remover');
