<?php

use App\Http\Controllers\BannersSobreNosController;
use App\Http\Controllers\NossaEquipeController;
use App\Http\Controllers\SobreNosController;
use Illuminate\Support\Facades\Route;


Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos.index');
Route::post('/sobre-nos/equipes/store', [NossaEquipeController::class, 'store'])->name('equipes.store');
Route::delete('/sobre-nos/{id}/equipes', [NossaEquipeController::class, 'destroy'])->name('equipes.destroy');
Route::put('/sobre-nos/{nossaEquipe}', [NossaEquipeController::class, 'update'])->name('equipes.update');
Route::get('/imagem/{filename}', [NossaEquipeController::class, 'exibirImagem']);
Route::post('/sobre-nos/store', [SobreNosController::class, 'store'])->name('sobrenos.store');
Route::patch('/sobre-nos/{id}', [SobreNosController::class, 'update'])->name('sobrenos.update');

// Rotas do controlador de banners
Route::get('/sobre-nos/banners', [BannersSobreNosController::class, 'index'])->name('banners.index');
Route::post('/sobre-nos/banners/store', [BannersSobreNosController::class, 'store'])->name('banners.store');
Route::delete('/sobre-nos/banners/{id}', [BannersSobreNosController::class, 'destroy'])->name('banners.destroy');

