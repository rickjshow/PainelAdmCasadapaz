<?php

use App\Http\Controllers\ComoAjudarController;
use Illuminate\Support\Facades\Route;

Route::get('/como-ajudar', [ComoAjudarController::class, 'index'])->name('como-ajudar.index');
