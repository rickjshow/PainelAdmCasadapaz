<?php

use App\Http\Controllers\UsersController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(CheckAdmin::class)->group(function () {
    // Rota para listar usuários
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    // Rota para salvar um novo usuário
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');

    // Rota para editar um usuário
    Route::patch('/users/{id}/edit', [UsersController::class, 'update'])->name('users.update');

    // Rota para excluir um usuário
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Rota para alterar a situação (ativo/desativo) de um usuário
    Route::post('/users/{id}/toggle-situation', [UsersController::class, 'toggleSituation'])->name('users.toggle-situation');

    // Rota para alterar o tipo de usuário (admin/user)
    Route::post('/users/{id}/toggle-type', [UsersController::class, 'toggleType'])->name('users.toggle-type');

    // Rota para resetar a senha de um usuário
    Route::post('/users/{id}/reset-password', [UsersController::class, 'resetPassword'])->name('users.reset-password');
});

