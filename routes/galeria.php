<?php

use App\Http\Controllers\GaleriaController;
use Illuminate\Support\Facades\Route;

Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
