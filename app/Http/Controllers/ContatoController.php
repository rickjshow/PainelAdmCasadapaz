<?php

namespace App\Http\Controllers;

use App\Models\BannerContato;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $img = BannerContato::all()->first();
        $content = Contato::all()->first();
        return view('contato.index', compact('content', 'img'));
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
        $validade = $request->validate([
            'whatsapp' => 'required|string',
            'instagram' => 'required|string',
            'fanpage' => 'required|string',
            'email' => 'required|string',
            'endereco_sede' => 'required|string',
            'endereco_bazar' => 'required|string',
            'instagram_bazar' => 'required|string'
        ]);

        Contato::create([
            'whatsapp' => $validade['whatsapp'],
            'instagram' => $validade['instagram'],
            'fanpage' => $validade['fanpage'],
            'email' => $validade['email'],
            'endereco_sede' => $validade['endereco_sede'],
            'endereco_bazar' => $validade['endereco_bazar'],
            'instagram_bazar' => $validade['instagram_bazar']
        ]);

        return redirect()->route('contato.index')->with('success', 'Contatos adicionados com sucesso!');
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
        // Validate incoming request data
        $validatedData = $request->validate([
            'whatsapp' => 'required|string',
            'instagram' => 'required|string',
            'fanpage' => 'required|string',
            'email' => 'required|string',
            'endereco_sede' => 'required|string',
            'endereco_bazar' => 'required|string',
            'instagram_bazar' => 'required|string'
        ]);

        // Find the existing record
        $contato = Contato::findOrFail($id);

        // Update the record with validated data
        $contato->update($validatedData);

        // Redirect with success message
        return redirect()->route('contato.index')->with('success', 'Contatos atualizados com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
