<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;

class DoacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Doacao::all()->first();
        return view('doacoes.index', compact('data'));
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
        // Validação dos dados recebidos
        $request->validate([
            'banco' => 'required|string|max:255',
            'agencia' => 'required|string|max:255',
            'conta_corrente' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14', // ajuste conforme necessário
            'titular' => 'required|string|max:255',
            'pix' => 'nullable|string|max:255',
        ]);

        // Criação de um novo registro na tabela doacaos
        Doacao::create($request->all());

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('doacao.index')->with('success', 'Doação criada com sucesso!');
    }


    // Atualiza uma doação existente
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'banco' => 'required|string|max:255',
            'agencia' => 'required|string|max:255',
            'conta_corrente' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14',
            'titular' => 'required|string|max:255',
            'pix' => 'nullable|string|max:255',
        ]);

        // Busca a doação pelo ID e atualiza com os dados fornecidos
        $doacao = Doacao::findOrFail($id);
        $doacao->update($request->all());

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('doacao.index')->with('success', 'Doação atualizada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
