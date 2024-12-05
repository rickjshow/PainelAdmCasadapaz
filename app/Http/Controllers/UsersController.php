<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
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
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Reset the user's password.
     */
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        // Define a nova senha com base no tipo de usuário
        $password = $user->type == 'admin' ? 'admin@123' : 'user@123';

        $user->update([
            'password' => bcrypt($password),
            'reset_password' => false, // Marca como senha resetada
        ]);

        return redirect()->route('users.index')->with('success', 'Senha resetada com sucesso!');
    }

    /**
     * Delete the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

    /**
     * Toggle the user's active status.
     */
    public function toggleSituation($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active; // Inverte o valor do campo is_active
        $user->save();

        return redirect()->route('users.index')->with('success', 'Situação do usuário alterada com sucesso!');
    }

    /**
     * Toggle the user's type (admin/user).
     */
    public function toggleType($id)
    {
        $user = User::findOrFail($id);
        $user->type = ($user->type === 'admin') ? 'user' : 'admin'; // Alterna entre admin e user
        $user->save();

        return redirect()->route('users.index')->with('success', 'Tipo do usuário alterado com sucesso!');
    }
}
