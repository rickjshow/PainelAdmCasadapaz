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

Route::post('/sobre-nos/banners/store', [BannersSobreNosController::class, 'store'])->name('banners-sobrenos.store');
Route::post('/imagens/{id}/remover/sobrenos', [BannersSobreNosController::class, 'remover'])->name('banners-sobrenos.remover');






