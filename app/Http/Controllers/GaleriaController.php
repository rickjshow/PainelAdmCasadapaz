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
        $eventos = Evento::withCount(['fotos', 'videos'])->get();
        $img = BannerGaleria::all()->first();
        $query = Galeria::query();

        if ($request->filled('evento_id')) {
            $query->where('evento_id', $request->evento_id);
        }
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
        }

        $galeria = $query->get();

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
            'arquivo.*' => 'required|file'
        ]);

        foreach ($request->file('arquivo') as $file) {
            $tipo = Str::startsWith($file->getMimeType(), 'image') ? 'foto' : 'video';

            if($tipo === 'foto')
            {
                $path = $file->store('fotos_galeria', 'public');
            } elseif($tipo === 'video')
            {
                $path = $file->store('videos_galeria', 'public');
            }


            Galeria::create([
                'evento_id' => $request->evento_id,
                'tipo' => $tipo,
                'arquivo' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Arquivos adicionados com sucesso.');
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
