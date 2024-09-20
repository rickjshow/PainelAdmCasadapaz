<?php

use App\Http\Controllers\DoacoesController;
use Illuminate\Support\Facades\Route;

Route::get('/doacoes', [DoacoesController::class, 'index'])->name('doacoes.index');
