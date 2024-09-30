<?php

use App\Http\Controllers\NossaEquipeController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

require base_path('routes/sobre_nos.php');
require base_path('routes/bazar.php');
require base_path('routes/como_ajudar.php');
require base_path('routes/contato.php');
require base_path('routes/doacoes.php');
require base_path('routes/galeria.php');
require base_path('routes/premios.php');
Route::get('/imagem/{id}', [NossaEquipeController::class, 'exibirImagem'])->name('exibir.imagem');
