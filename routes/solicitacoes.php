<?php

use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\TemplateEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/solicitacoes', [SolicitacaoController::class, 'index'])->name('solicitacoes.index');
Route::post('/solicitacoes/{id}/responder', [SolicitacaoController::class, 'responder'])->name('solicitacoes.responder');

Route::put('/templates/update', [TemplateEmailController::class, 'update'])->name('templates.update');



