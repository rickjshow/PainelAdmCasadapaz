<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function update(Request $request)
    {
        // Validação das entradas
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Recuperar o ID do usuário da sessão
        $userId = session('password_reset_user_id');

        if (!$userId) {
            return redirect()->route('password.change.view')->withErrors(['error' => 'Sessão expirada. Faça login novamente.']);
        }

        // Obter o usuário pelo ID
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('password.change.view')->withErrors(['error' => 'Usuário não encontrado.']);
        }

        // Validar se a nova senha é diferente da senha atual
        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('password.change.view')->withErrors(['password' => 'A nova senha não pode ser igual à senha atual.']);
        }

        // Atualizar a senha e resetar o campo reset_password
        $user->update([
            'password' => Hash::make($request->password),
            'reset_password' => true, // Marca como senha alterada
        ]);

        // Limpar o ID da sessão
        $request->session()->forget('password_reset_user_id');

        // Regenerar o token da sessão para segurança
        $request->session()->regenerate();

        // Redirecionar para o dashboard com mensagem de sucesso
        return redirect()->route('dashboard')->with('status', 'Senha alterada com sucesso!');
    }
}



