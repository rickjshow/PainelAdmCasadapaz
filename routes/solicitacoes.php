<?php

use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/solicitacoes', [SolicitacaoController::class, 'index'])->name('solicitacoes.index');
Route::post('/solicitacoes/{id}/responder', [SolicitacaoController::class, 'responder'])->name('solicitacoes.responder');