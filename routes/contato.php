<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
