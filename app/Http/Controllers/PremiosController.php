<?php

namespace App\Http\Controllers;

use App\Models\BannerPremio;
use App\Models\Premio;
use App\Models\TextoPremio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PremiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $img = BannerPremio::all()->first();
        $texto = TextoPremio::all()->first();
        $premios = Premio::all();

        return view('premios.index', compact('img', 'texto', 'premios'));
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
        'descricao' => 'required|string',
        'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $fotoPath = null;
            if ($request->hasFile('imagem')) {
                $fotoPath = $request->file('imagem')->store('imagem_premios');
            }

            Premio::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'imagem' => $fotoPath
            ]);

    return redirect()->back()->with('success', 'Prêmio adicionado com sucesso!');
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
        $premio = Premio::findOrFail($id);
    
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $fotoPath = $premio->imagem;
    
        if ($request->hasFile('imagem')) {
            if ($fotoPath) {
                Storage::delete($fotoPath);
            }
            $fotoPath = $request->file('imagem')->store('imagem_premios');
        }
    
        $premio->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'imagem' => $fotoPath
        ]);
    
        return redirect()->back()->with('success', 'Prêmio atualizado com sucesso!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $premio = Premio::findOrFail($id);

        $premio->delete();

        return redirect()->back()->with('success', 'Prêmio deletado com sucesso!');
    }
}
