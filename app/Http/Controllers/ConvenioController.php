<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $convenios = Convenio::paginate(5);
        return view('convenios.index', compact('convenios'));
    
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
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:Parceria,Convenio',
        ]);
    
        Convenio::create([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
        ]);
    
        return redirect()->route('convenios.index')->with('success', 'Cadastro realizado com sucesso!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:Parceria,Convenio',
        ]);
    
        $convenio = Convenio::findOrFail($id);
        $convenio->update([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
        ]);
    
        return redirect()->back()->with('success', 'Atualizado com sucesso!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $convenio = Convenio::findOrFail($id);
        $convenio->delete();
        return redirect()->back()->with('success', 'Excluído com sucesso!');
    }
}
