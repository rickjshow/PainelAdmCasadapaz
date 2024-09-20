<?php

use App\Http\Controllers\BazarController;
use Illuminate\Support\Facades\Route;

Route::get('/bazar', [BazarController::class, 'index'])->name('bazar.index');
