<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConvenioController;

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
Route::post('/convenios/store', [ConvenioController::class, 'store'])->name('convenios.store');
Route::put('/convenios/update/{id}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/delete/{id}', [ConvenioController::class, 'destroy'])->name('convenios.destroy');