<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::post('/contato/store', [ContatoController::class, 'store'])->name('contato.store');
Route::patch('/contato/{id}', [ContatoController::class, 'update'])->name('contato.update');
