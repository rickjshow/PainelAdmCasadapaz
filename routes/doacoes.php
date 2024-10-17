<?php

use App\Http\Controllers\DoacoesController;
use Illuminate\Support\Facades\Route;

Route::get('/doacao', [DoacoesController::class, 'index'])->name('doacao.index');
Route::post('/doacao/store', [DoacoesController::class, 'store'])->name('doacao.store');
Route::patch('doacao/{id}/edit', [DoacoesController::class, 'update'])->name('doacao.update');
