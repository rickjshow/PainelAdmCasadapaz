<?php

use App\Http\Controllers\PremiosController;
use Illuminate\Support\Facades\Route;

Route::get('/premios', [PremiosController::class, 'index'])->name('premios.index');
