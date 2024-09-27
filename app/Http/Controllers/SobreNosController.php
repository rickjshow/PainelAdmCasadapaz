<?php

namespace App\Http\Controllers;

use App\Models\Nossaequipe;
use App\Models\Sobrenos;
use Illuminate\Auth\Events\Validated;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class SobreNosController extends Controller
{

    public function index()
    {
            $equipes = Nossaequipe::all();
            $content = Sobrenos::all()->first();
            return view('sobre_nos.index', compact('equipes', 'content'));

    }

    public function create()
    {
        
    }

    public function addImagens(Request $request)
    {
          
    }

    public function editImagens(Request $request, $id)
    {

    }

    public function destroyImagens(string $id)
    {

    }

    public function store(Request $request)
    {
        $validade = $request->validate([
            'sobre' => 'required|string',
            'no_que_acreditamos' => 'required|string',
            'atividades' => 'required|string',
            'recursos' => 'required|string',
            'sede' => 'required|string'
        ]);

        Sobrenos::create([
            'sobre' => $validade['sobre'],
            'no_que_acreditamos' => $validade['no_que_acreditamos'],
            'atividades' => $validade['atividades'],
            'recursos' => $validade['recursos'],
            'sede' => $validade['sede']
        ]);

        return redirect()->route('sobre-nos.index')->with('success', 'Descrições adicionadas com sucesso!');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sobre' => 'nullable|string',
            'no_que_acreditamos' => 'nullable|string',
            'atividades' => 'nullable|string',
            'recursos' => 'nullable|string',
            'sede' => 'nullable|string',
        ]);

        $sobrenos = Sobrenos::findOrFail($id);

        $sobrenos->sobre = $request->input('sobre');
        $sobrenos->no_que_acreditamos = $request->input('no_que_acreditamos');
        $sobrenos->atividades = $request->input('atividades');
        $sobrenos->recursos = $request->input('recursos');
        $sobrenos->sede = $request->input('sede');

        $sobrenos->save();

        return redirect()->route('sobre-nos.index')->with('success', 'Informações atualizadas com sucesso!');
    }

    public function destroy(string $id)
    {
        //
    }
}
