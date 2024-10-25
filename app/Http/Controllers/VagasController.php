<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VagasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vagas = Vaga::all();

        return view('como_ajudar.vagas', compact('vagas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vaga' => 'required|string|max:255',
            'necessidade' => 'required|string',
        ]);

        Vaga::create([
            'vaga' => $request->vaga,
            'necessidade' => $request->necessidade
        ]);

        return redirect()->route('como-ajudar.index')->with('success', 'Vaga adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vaga = Vaga::findOrFail($id);

        return view('como_ajudar.vagas', compact('vaga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Vaga::findOrFail($id);

        try{
            $request->validate([
                'vaga' => 'required|string',
                'necessidade' => 'required|string'
            ]);

            $item->update([
                'vaga' => $request->vaga,
                'necessidade' => $request->necessidade
            ]);

            return redirect()->route('como-ajudar.index')->with('success', 'Vaga Atualizada com Sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar vaga: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar a vaga.');
        }
    }

    public function destroy(string $id)
    {
        $vaga = Vaga::findOrFail($id);

        $vaga->delete(); // Exclui a vaga

        return redirect()->route('como-ajudar.index')->with('success', 'Vaga excluída com sucesso!');
    }
}
