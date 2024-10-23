<?php

use App\Http\Controllers\BannersContatoController;
use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::post('/contato/store', [ContatoController::class, 'store'])->name('contato.store');
Route::patch('/contato/{id}', [ContatoController::class, 'update'])->name('contato.update');

Route::post('/contato/banners/store', [BannersContatoController::class, 'store'])->name('banners-contato.store');
Route::post('/imagens/{id}/remover/contato', [BannersContatoController::class, 'remover'])->name('banners-contato.remover');
