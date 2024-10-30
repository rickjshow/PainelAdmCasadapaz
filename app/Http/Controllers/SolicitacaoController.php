<?php

namespace App\Http\Controllers;

use App\Mail\RespostaSolicitacaoMail;
use App\Models\Solicitacao;
use App\Models\TemplateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SolicitacaoController extends Controller
{

    public function index()
    {
        $textosEmail = TemplateEmail::all();
        $novasSolicitacoes = Solicitacao::where('status', 'pendente')->get();
        $solicitacoesRespondidas = Solicitacao::where('status', 'respondida')->get();

        return view('solicitacoes.index', compact('novasSolicitacoes', 'solicitacoesRespondidas', 'textosEmail'));
    }

    public function responder(Request $request, $id)
    {
        $request->validate([
            'aprovacao' => 'required|in:aprovada,reprovada',
            'resposta' => 'nullable|string',
        ]);

        $solicitacao = Solicitacao::findOrFail($id);

        $solicitacao->status = 'respondida';
        $solicitacao->aprovacao = $request->input('aprovacao');
        $solicitacao->mensagem_resposta = $request->input('resposta');
        $solicitacao->save();

        Mail::to($solicitacao->email)->send(new RespostaSolicitacaoMail($solicitacao, $request->input('resposta')));

        return redirect()->route('solicitacoes.index')->with('success', 'Solicitação respondida e e-mail enviado com sucesso!');
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
}
