<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Lista de Solicitações</h2>

        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav nav-tabs" id="solicitacoesTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="novas-solicitacoes-tab" data-bs-toggle="tab" href="#novas-solicitacoes" role="tab" aria-controls="novas-solicitacoes" aria-selected="true">Novas Solicitações</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="solicitacoes-respondidas-tab" data-bs-toggle="tab" href="#solicitacoes-respondidas" role="tab" aria-controls="solicitacoes-respondidas" aria-selected="false">Solicitações Respondidas</a>
                </li>
            </ul>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarTemplatesModal">
                Editar Email
            </button>
        </div>

        <div class="tab-content" id="solicitacoesTabContent">
            <div class="tab-pane fade show active" id="novas-solicitacoes" role="tabpanel" aria-labelledby="novas-solicitacoes-tab">
                <div class="mt-4 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Nome</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Vaga</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($novasSolicitacoes) && $novasSolicitacoes->isNotEmpty())
                            @foreach($novasSolicitacoes as $solicitacao)
                            <tr>
                                <td class="text-center">{{ $solicitacao->nome }}</td>
                                <td class="text-center">{{ $solicitacao->email }}</td>
                                <td class="text-center">{{ $solicitacao->nome_vaga }}</td>
                                <td class="text-center">{{ $solicitacao->created_at ? \Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y H:i') : 'Data não disponível' }}

                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#responderModal{{ $solicitacao->id }}">
                                        <i class="fas fa-reply"></i> Responder
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="responderModal{{ $solicitacao->id }}" tabindex="-1" aria-labelledby="responderModalLabel{{ $solicitacao->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Responder Solicitação</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('solicitacoes.responder', $solicitacao->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Aprovação</label>
                                                    <select class="form-select" id="aprovacao" name="aprovacao" required>
                                                        <option value="" disabled selected>Selecione uma opção</option>
                                                        <option value="aprovada">Aprovar</option>
                                                        <option value="reprovada">Reprovar</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="resposta" class="form-label">Mensagem de Resposta (opcional)</label>
                                                    <textarea class="form-control" id="resposta" name="resposta" rows="4"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Enviar Resposta</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Não há novas solicitações.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="solicitacoes-respondidas" role="tabpanel" aria-labelledby="solicitacoes-respondidas-tab">
                <div class="mt-4 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Nome</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Vaga</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Aprovação</th>
                                <th class="text-center">Ver Resposta</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($solicitacoesRespondidas) && $solicitacoesRespondidas->isNotEmpty())
                            @foreach($solicitacoesRespondidas as $solicitacao)
                            <tr>
                                <td class="text-center">{{ $solicitacao->nome }}</td>
                                <td class="text-center">{{ $solicitacao->email }}</td>
                                <td class="text-center">{{ $solicitacao->nome_vaga }}</td>
                                <td class="text-center">{{ $solicitacao->updated_at ? \Carbon\Carbon::parse($solicitacao->updated_at)->format('d/m/Y H:i') : 'Data não disponível' }}


                                </td>
                                <td class="text-center">{{ $solicitacao->aprovacao }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verRespostaModal{{ $solicitacao->id }}">
                                        Ver Resposta
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="verRespostaModal{{ $solicitacao->id }}" tabindex="-1" aria-labelledby="verRespostaModalLabel{{ $solicitacao->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="verRespostaModalLabel{{ $solicitacao->id }}">Resposta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="resposta{{ $solicitacao->id }}" class="form-label">Mensagem de Resposta</label>
                                                <textarea class="form-control" id="resposta{{ $solicitacao->id }}" rows="4" readonly>{{ $solicitacao->mensagem_resposta ?? 'Nenhuma resposta foi enviada para esta solicitação.' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Não há solicitações respondidas.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="editarTemplatesModal" tabindex="-1" aria-labelledby="editarTemplatesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarTemplatesModalLabel">Editar Templates de Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('templates.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if($textosEmail && $textosEmail->isNotEmpty())
                        @foreach($textosEmail as $template)
                            <div class="mb-3">
                                <label for="template_{{ $template->id }}" class="form-label">{{ $template->key }}</label>
                                <textarea
                                    class="form-control"
                                    id="template_{{ $template->id }}"
                                    name="templates[{{ $template->id }}][conteudo]"
                                    rows="4">{{ $template->conteudo }}</textarea>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhum template encontrado.</p>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
