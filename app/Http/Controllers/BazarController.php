<?php

namespace App\Http\Controllers;

use App\Models\BannerBazar;
use App\Models\ImagemBazar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BazarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retorna um array associativo de 'id' => 'imagem_bazar'
        $items = ImagemBazar::pluck('imagem_bazar', 'id');
        $img = BannerBazar::all()->first();
        return view('bazar.index', compact('items', 'img'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addImg(Request $request)
    {
        $request->validate([
            'imagem_bazar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagem_bazar')) {
            $filePath = $request->file('imagem_bazar')->store('bazar', 'public');
            ImagemBazar::create(['imagem_bazar' => $filePath]);

            return redirect()->back()->with('success', 'Imagem adicionada com sucesso!');
        }

        return redirect()->back()->withErrors('Erro ao enviar a imagem.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyImg(string $id)
{
    $imagem = ImagemBazar::findOrFail($id);

    // Verifique se o arquivo realmente existe
    if (Storage::disk('public')->exists($imagem->imagem_bazar)) {
        // Remova o arquivo
        Storage::disk('public')->delete($imagem->imagem_bazar);
    }

    // Exclua o registro do banco de dados
    $imagem->delete();

    // Retorne uma resposta JSON com sucesso (200 OK)
    return response()->json(['message' => 'Imagem removida com sucesso!'], 200);
}

}
