<?php

use App\Http\Controllers\BannersComoAjudarController;
use App\Http\Controllers\ComoAjudarController;
use App\Http\Controllers\VagasController;
use Illuminate\Support\Facades\Route;

Route::get('/como-ajudar', [ComoAjudarController::class, 'index'])->name('como-ajudar.index');
Route::post('/como-ajudar/store', [ComoAjudarController::class, 'store'])->name('como-ajudar.store');
Route::get('/como-ajudar/{id}/edit', [ComoAjudarController::class, 'edit'])->name('como-ajudar.edit');
Route::put('/como-ajudar/{id}/update', [ComoAjudarController::class, 'update'])->name('como-ajudar.update');
Route::delete('/como-ajudar/{id}/destroy', [ComoAjudarController::class, 'destroy'])->name('como-ajudar.destroy');

Route::post('/como-ajudar/banners/store', [BannersComoAjudarController::class, 'store'])->name('banners-comoajudar.store');
Route::post('/imagens/{id}/remover/como-ajudar', [BannersComoAjudarController::class, 'remover'])->name('banners-comoajudar.remover');

Route::post('/como-ajudar/vagas/store', [VagasController::class, 'store'])->name('vagas.store');
Route::get('/como-ajudar/vagas/{id}/edit', [VagasController::class, 'edit'])->name('vagas.edit');
Route::put('/como-ajudar/vagas/{id}/update', [VagasController::class, 'update'])->name('vagas.update');
Route::delete('/como-ajudar/vagas/{id}/destroy', [VagasController::class, 'destroy'])->name('vagas.destroy');

