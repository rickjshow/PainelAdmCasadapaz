<?php

namespace App\Http\Controllers;

use App\Models\BannerComoAjudar;
use App\Models\Comoajudar;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComoAjudarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vagas = Vaga::all();
        $content = Comoajudar::all();
        $img = BannerComoAjudar::all()->first();
        return view('como_ajudar.index', compact('img', 'content', 'vagas'));
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
        $validate = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string'
        ]);

        Comoajudar::create([
            'titulo' => $validate['titulo'],
            'descricao' => $validate['descricao']
        ]);

        return redirect()->route('como-ajudar.index')->with('success', 'Item adicionado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $editItem = Comoajudar::findOrFail($id);
        return view('como_ajudar.index', compact('editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Comoajudar::findOrFail($id);

        try{
            $request->validate([
                'titulo' => 'required|string',
                'descricao' => 'required|string'
            ]);

            $item->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao
            ]);

            return redirect()->route('como-ajudar.index')->with('success', 'Item Atualizado com Sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar item: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar o item.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Comoajudar::findOrFail($id);

        $item->delete();

        return redirect()->route('como-ajudar.index')->with('success', 'Item deletado com sucesso!');
    }
}
