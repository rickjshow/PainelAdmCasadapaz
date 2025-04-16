<?php

use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\NossaEquipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordChangeController;

Route::get('/', function() {
    return redirect('/login');
})->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});

Route::middleware(['guest'])->group(function () {
    // Rota para exibir a página de login
    Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])->name('login');

    // Rota para processar o login
    Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    // Rota para logout
    Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');
});

    // Exibir o formulário de alteração de senha
Route::get('/change-password', function () {
    return view('auth.change-password'); // Certifique-se de que a view existe
})->name('password.change.view');

    // Processar a alteração de senha
Route::post('/change-password', [PasswordChangeController::class, 'update'])
    ->name('password.change');



require base_path('routes/sobre_nos.php');
require base_path('routes/bazar.php');
require base_path('routes/como_ajudar.php');
require base_path('routes/contato.php');
require base_path('routes/doacoes.php');
require base_path('routes/galeria.php');
require base_path('routes/premios.php');
require base_path('routes/solicitacoes.php');
require base_path('routes/users.php');
require base_path('routes/convenios.php');
Route::get('/imagem/{id}', [NossaEquipeController::class, 'exibirImagem'])->name('exibir.imagem');
