<?php

use App\Http\Controllers\BannersGaleriaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\GaleriaController;
use Illuminate\Support\Facades\Route;

Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
Route::delete('/galeria/{id}/destroy', [GaleriaController::class, 'destroy'])->name('galeria.destroy');


Route::post('/galeria/banners/store', [BannersGaleriaController::class, 'store'])->name('banners-galeria.store');
Route::post('/imagens/{id}/remover/galeria', [BannersGaleriaController::class, 'remover'])->name('banners-galeria.remover');

Route::post('/galeria/eventos/store', [EventoController::class, 'store'])->name('eventos.store');
Route::put('galeria/eventos/{id}/edit', [EventoController::class, 'update'])->name('eventos.update');
Route::delete('galeria/eventos/{id}/destroy', [EventoController::class, 'destroy'])->name('eventos.destroy');

Route::delete('/galeria/excluir-selecionadas', [GaleriaController::class, 'destroyMultiple'])->name('galeria.excluir-selecionados');

