<?php

use App\Http\Controllers\NossaEquipeController;
use App\Http\Controllers\SobreNosController;
use App\Models\Nossaequipe;
use Illuminate\Support\Facades\Route;

Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos.index');
Route::post('/sobre-nos/store', [NossaEquipeController::class, 'store'])->name('equipes.store');
Route::delete('/sobre-nos/{id}', [NossaEquipeController::class, 'destroy'])->name('equipes.destroy');
Route::put('/sobre-nos/{nossaEquipe}', [NossaEquipeController::class, 'update'])->name('equipes.update');
Route::get('/imagem/{filename}', [NossaEquipeController::class, 'exibirImagem']);

