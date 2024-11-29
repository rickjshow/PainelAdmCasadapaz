<?php

namespace App\Http\Controllers;

use App\Models\BannerGaleria;
use App\Models\Evento;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $eventos = Evento::withCount(['fotos'])->get();
        $img = BannerGaleria::all()->first();
        $query = Galeria::query();

        if ($request->filled('evento_id')) {
            $query->where('evento_id', $request->evento_id);
        }
        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
        }

        $galeria = $query->where('tipo', 'foto')->get();

        return view('galeria.index', compact('galeria', 'eventos', 'img'));
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
            'arquivo.*' => 'required|file|mimes:jpeg,jpg,png,gif' // Apenas imagens são aceitas
        ]);

        foreach ($request->file('arquivo') as $file) {
            $path = $file->store('fotos_galeria', 'public');

            Galeria::create([
                'evento_id' => $request->evento_id,
                'tipo' => 'foto',
                'arquivo' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Imagens adicionadas com sucesso.');
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
    public function destroy($id)
    {
        $item = Galeria::findOrFail($id);

        if ($item->arquivo && Storage::disk('public')->exists($item->arquivo)) {
            Storage::disk('public')->delete($item->arquivo);
        }

        $item->delete();

        return response()->json([
            'message' => 'Imagem excluída com sucesso!',
            'redirect_url' => route('galeria.index')
        ], 200);
    }
}
