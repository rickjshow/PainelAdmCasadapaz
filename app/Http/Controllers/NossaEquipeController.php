<?php

namespace App\Http\Controllers;

use App\Models\Nossaequipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NossaEquipeController extends Controller
{
    public function index() {}

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

            $fotoBlob = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('fotos');
                // Lê o conteúdo da imagem para armazenar como BLOB
                $fotoBlob = file_get_contents($request->file('foto')->getRealPath());
            }

            Nossaequipe::create([
                'foto' => $fotoBlob,
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

        if (!$equipe || !$equipe->foto) {
            abort(404);
        }

        return response()->stream(function () use ($equipe) {
            echo $equipe->foto;
        }, 200, [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'inline; filename="foto.jpg"',
        ]);
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

            $foto = $nossaEquipe->foto;

            if ($request->hasFile('foto')) {
                $foto = file_get_contents($request->file('foto')->getRealPath());
            }

            $nossaEquipe->update([
                'foto' => $foto,
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
            $nossaEquipe->delete();
            return redirect()->route('equipe.index')->with('success', 'Membro removido com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao remover membro: ' . $e->getMessage());
            return back()->withErrors('Erro ao remover o membro.');
        }
    }
}
