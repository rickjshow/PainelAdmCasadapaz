<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Galeria;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::withCount(['fotos', 'videos'])->get();
        return view('galeria.evento', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'data' => 'required|date'
        ]);

        Evento::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data' => $request->data
        ]);

        return redirect()->back()->with('success', 'Evento adicionado com sucesso!');
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
        $evento = Evento::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'data' => 'required|date'
        ]);

        $evento->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data' => $request->data
        ]);

        return redirect()->back()->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Evento::findOrFail($id);

        // Verificar se há registros associados na tabela galeria
        $galeriaCount = Galeria::where('evento_id', $id)->count();

        if ($galeriaCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Este evento possui registros na galeria e não pode ser excluído!'
            ], 400);
        }

        // Excluir o evento se não houver registros na galeria
        $evento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento excluído com sucesso!'
        ], 200);
    }
}
