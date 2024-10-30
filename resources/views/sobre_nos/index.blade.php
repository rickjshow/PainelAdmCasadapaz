<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

        <h2 class="text-2xl font-bold mb-4 text-center">Sobre Nós</h2>

        <form action="{{ route('banners-sobrenos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-md rounded-lg p-4" style="height: 250px;">
                        <h5 class="font-semibold text-lg">Banner Desktop</h5>
                        <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 1920x170 </h4>
                        @if(isset($img) && $img->banner_principal)
                            <img src="{{ asset('storage/' . $img->banner_principal) }}" class="img-fluid mb-2" style="max-width: 400px; max-height: 50px;" />
                            <button type="button" class="btn btn-danger btn-sm mt-3" onclick="removeBanner('{{ $img->id }}', 'banner_principal')">
                                <i class="fa fa-trash"></i> Excluir
                            </button>
                        @endif
                        <input type="file" accept="image/*" name="banner_principal" class="form-control mb-2" />
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-md rounded-lg p-4" style="height: 250px;">
                        <h5 class="font-semibold text-lg">Banner Mobile</h5>
                        <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 1000x500</h4>
                        @if(isset($img) && $img->banner_principal_mobile)
                            <img src="{{ asset('storage/' . $img->banner_principal_mobile) }}" class="img-fluid mb-2" style="max-width: 120px; max-height: 50px;" />
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeBanner('{{ $img->id }}', 'banner_principal_mobile')">
                                <i class="fa fa-trash"></i> Excluir
                            </button>
                        @endif
                        <input type="file" accept="image/*" name="banner_principal_mobile" class="form-control mb-2" />
                    </div>
                </div>
            </div>

            <div class="card shadow-md rounded-lg p-4 mb-4 align">
                <h5 class="font-semibold text-lg">Imagem da Missão</h5>
                <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 341x464</h4>
                @if(isset($img) && $img->imagem_missao)
                    <img src="{{ asset('storage/' . $img->imagem_missao) }}" class="img-fluid mb-2" style="max-width: 100px;" />
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeBanner('{{ $img->id }}', 'imagem_missao')">
                        <i class="fa fa-trash"></i> Excluir
                    </button>
                @endif
                <input type="file" accept="image/*" name="imagem_missao" class="form-control mb-2" />
            </div>

            <button type="submit" class="btn btn-success mb-4 mt-2">Salvar</button>
        </form>

        <script>
            function removeBanner(id, type) {
                showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
                    fetch(`{{ url('/imagens') }}/${id}/remover/sobrenos`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ type: type })
                    })
                    .then(response => {
                        if (response.ok) {
                            return showSuccessAlert('Excluído!', 'O banner foi excluído com sucesso.');
                        } else {
                            showErrorAlert('Erro!', 'Não foi possível excluir o banner.');
                            throw new Error('Erro na resposta');
                        }
                    })
                    .then(() => {
                        location.reload();
                    })
                    .catch(error => console.error('Erro:', error));
                });
            }
        </script>

        <form action="{{ isset($content) ? route('sobrenos.update', $content->id) : route('sobrenos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($content))
                @method('PATCH')
            @endif

            <div class="row mb-4 mt-4">
                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">Missão</h5>
                        <textarea name="missao" class="form-control" rows="3">{{ isset($content) ? $content->missao : '' }}</textarea>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">Sobre a Casa da Paz</h5>
                        <textarea name="sobre" class="form-control" rows="3">{{ isset($content) ? $content->sobre : '' }}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">No que acreditamos?</h5>
                        <textarea name="no_que_acreditamos" class="form-control" rows="3">{{ isset($content) ? $content->no_que_acreditamos : '' }}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">Onde e como as atividades acontecem?</h5>
                        <textarea name="atividades" class="form-control" rows="3">{{ isset($content) ? $content->atividades : '' }}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">De onde vêm os recursos?</h5>
                        <textarea name="recursos" class="form-control" rows="3">{{ isset($content) ? $content->recursos : '' }}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="card shadow-md rounded-lg p-4">
                        <h5 class="font-semibold text-lg mb-2">Sede própria!</h5>
                        <textarea name="sede" class="form-control" rows="3">{{ isset($content) ? $content->sede : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>

        <h2 class="text-2xl font-bold mb-4 text-center">Equipe</h2>

        <button type="button" class="btn btn-primary mb-4" id="openModalCreate">
            Adicionar Membro
        </button>

    <div class="row">
    @if(isset($equipes) && $equipes->isNotEmpty())
        @foreach ($equipes as $equipe)
            <div class="col-md-2 text-center mb-4">
                <div class="card mb-4 shadow-sm border-light">
                    <div style="overflow: hidden;">
                        <img src="{{ route('exibir.imagem', ['id' => $equipe->id]) }}" alt="Foto da equipe" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $equipe->nome }}</h5>
                        <p class="card-text">{{ $equipe->cargo }}</p>
                        <p class="card-text text-muted">{{ $equipe->profissao }}</p>
                        <button class="btn btn-warning open-modal-btn" data-id="{{ $equipe->id }}">
                            Editar
                        </button>
                        <form action="{{ route('equipes.destroy', $equipe->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal de Edição -->
            <div class="modal fade" id="modalEdit{{ $equipe->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $equipe->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('equipes.update', $equipe->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel{{ $equipe->id }}">Editar Membro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" value="{{ $equipe->nome }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cargo" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" name="cargo" value="{{ $equipe->cargo }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Profissão</label>
                                    <textarea class="form-control" name="profissao" required>{{ $equipe->profissao }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <h5 class="mb-2 mt-2">Tamanho recomendado da imagem: 405x417</h5>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <p class="text-muted">Nenhum membro encontrado.</p>
        </div>
    @endif
</div>

<!-- Script para Abertura do Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openModalBtns = document.querySelectorAll('.open-modal-btn');

        openModalBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var modal = document.getElementById('modalEdit' + id);
                var modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            });
        });
    });
</script>


        <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('equipes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCreateLabel">Adicionar Membro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" name="cargo" required>
                            </div>
                            <div class="mb-3">
                                <label for="profissao" class="form-label">Profissão</label>
                                <textarea class="form-control" name="profissao" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <h5 class="mb-2 mt-2">Tamanho recomendado da imagem: 405x417</h5>
                                <input type="file" class="form-control" name="foto" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Adicionar Membro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('openModalCreate').addEventListener('click', function() {
                var modalCreate = new bootstrap.Modal(document.getElementById('modalCreate'));
                modalCreate.show();
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('.delete-form');
                    showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                _method: 'DELETE',
                            })
                        })
                        .then(response => {
                            if (response.ok) {
                                showSuccessAlert('Excluído!', 'O membro foi excluído com sucesso.')
                                    .then(() => {
                                        location.reload();
                                    });
                            } else {
                                showErrorAlert('Erro!', 'Não foi possível excluir o membro.');
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            showErrorAlert('Erro!', 'Ocorreu um erro ao excluir o membro.');
                        });
                    });
                });
            });
        </script>
    </div>
</x-app-layout>
