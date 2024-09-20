<?php

use App\Http\Controllers\SobreNosController;
use Illuminate\Support\Facades\Route;

Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos.index');
