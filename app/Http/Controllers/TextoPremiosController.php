<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TextoPremio;

class TextoPremiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $texto = TextoPremio::all()->first();

        return view('premios.index', compact('texto'));
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
            'texto_principal' => 'required|string'
        ]);

        TextoPremio::create([
            'texto_principal' => $request->texto_principal
        ]);

        return redirect()->route('premios.index')->with('success', 'Texto inserido com sucesso!');
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
            'texto_principal' => 'required|string'
        ]);

        $texto = TextoPremio::findOrFail($id);

        $texto->update([
            'texto_principal' => $request->texto_principal
        ]);

        return redirect()->route('premios.index')->with('success', 'Texto Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
