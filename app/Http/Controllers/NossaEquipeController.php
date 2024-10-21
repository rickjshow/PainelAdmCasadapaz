<?php

namespace App\Http\Controllers;

use App\Models\Nossaequipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NossaEquipeController extends Controller
{
    public function index()
    {
        $equipes = Nossaequipe::all();
        return view('equipe.index', compact('equipes'));
    }

    public function create()
    {
        return view('equipe.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
                'nome' => 'required|string|max:255',
                'cargo' => 'required|string|max:255',
                'profissao' => 'required|string|max:255',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('fotos');
            }

            Nossaequipe::create([
                'foto' => $fotoPath,
                'nome' => $request->nome,
                'cargo' => $request->cargo,
                'profissao' => $request->profissao,
            ]);

            return redirect()->route('equipe.index')->with('success', 'Membro adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao adicionar membro: ' . $e->getMessage());
            return back()->withErrors('Erro ao adicionar o membro: ' . $e->getMessage());
        }
    }

    public function exibirImagem($id)
    {
        $equipe = Nossaequipe::findOrFail($id);

        if (!$equipe || !$equipe->foto || !Storage::exists($equipe->foto)) {
            abort(404);
        }

        return response()->file(Storage::path($equipe->foto));
    }

    public function edit(Nossaequipe $nossaEquipe)
    {
        return view('equipe.edit', compact('nossaEquipe'));
    }

    public function update(Request $request, $id)
    {
        $nossaEquipe = Nossaequipe::findOrFail($id);

        try {
            $request->validate([
                'foto' => 'nullable|image|max:2048',
                'nome' => 'required|string|max:255',
                'cargo' => 'required|string|max:255',
                'profissao' => 'required|string|max:255',
            ]);

            $fotoPath = $nossaEquipe->foto;

            if ($request->hasFile('foto')) {
                // Remove a imagem anterior, se existir
                if ($fotoPath) {
                    Storage::delete($fotoPath);
                }
                $fotoPath = $request->file('foto')->store('fotos');
            }

            $nossaEquipe->update([
                'foto' => $fotoPath,
                'nome' => $request->nome,
                'cargo' => $request->cargo,
                'profissao' => $request->profissao,
            ]);

            return redirect()->route('equipe.index')->with('success', 'Membro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar membro: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar o membro.');
        }
    }

    public function destroy($id)
    {
        try {
            $nossaEquipe = Nossaequipe::findOrFail($id);

            // Remove a imagem associada, se existir
            if ($nossaEquipe->foto) {
                Storage::delete($nossaEquipe->foto);
            }

            $nossaEquipe->delete();
            return redirect()->route('equipe.index')->with('success', 'Membro removido com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao remover membro: ' . $e->getMessage());
            return back()->withErrors('Erro ao remover o membro.');
        }
    }
}
