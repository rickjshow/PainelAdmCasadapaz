<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usuário logado
        $currentUser = Auth::user();

        // Buscar todos os usuários, exceto o usuário logado
        $users = User::where('id', '!=', $currentUser->id)->get();

        return view('users.index', compact('users', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'type' => 'required|in:admin,user',
    ]);

    // Define a senha padrão com base no tipo de usuário
    $password = $request->type == 'admin' ? 'admin@123' : 'user@123';

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($password),
        'type' => $request->type,
        'situation' => 'ativo'
    ]);

    return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
}

public function resetPassword($id)
{
    $user = User::findOrFail($id);

    // Define a nova senha com base no tipo de usuário
    $password = $user->type == 'admin' ? 'admin@123' : 'user@123';

    $user->update([
        'password' => bcrypt($password),
    ]);

    return redirect()->route('users.index')->with('success', 'Senha resetada com sucesso!');
}

    // Excluir usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

    // Alterar situação do usuário (ativar/desativar)
    public function toggleSituation($id)
    {
        $user = User::findOrFail($id);
        $user->situation = !$user->situation;  // Inverte a situação
        $user->save();

        return redirect()->route('users.index')->with('success', 'Situação do usuário alterada com sucesso!');
    }

    // Alterar tipo de usuário (admin/user)
    public function toggleType($id)
    {
        $user = User::findOrFail($id);
        $user->type = ($user->type === 'admin') ? 'user' : 'admin';  // Alterna entre admin e user
        $user->save();

        return redirect()->route('users.index')->with('success', 'Tipo do usuário alterado com sucesso!');
    }
}
