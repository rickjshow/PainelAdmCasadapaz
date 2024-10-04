<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::post('/contatos', [ContatoController::class, 'store'])->name('contatos.store');
