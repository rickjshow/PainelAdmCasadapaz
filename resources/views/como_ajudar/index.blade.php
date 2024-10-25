<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Página Como Ajudar</h2>

                <form action="{{ route('banners-comoajudar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-md rounded-lg p-4" style="height: 250px;">
                                <h5 class="font-semibold text-lg">Banner Desktop</h5>
                                <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 1920x170</h4>
                                @if(isset($img) && $img->banner_principal)
                                    <img src="{{ asset('storage/' . $img->banner_principal) }}" class="img-fluid mb-2" style="max-width: 400px; max-height: 50px;" />
                                    <button type="button" class="btn btn-danger btn-sm mt-3" onclick="removeBanner('{{ $img->id }}', 'banner_principal')">
                                        <i class="fa fa-trash"></i> Excluir</button>
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
                    <button type="submit" class="btn btn-success mb-4 mt-2">Salvar</button>
                </form>

                <ul class="nav nav-tabs mb-4 mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="como-ajudar-tab" data-bs-toggle="tab" href="#como-ajudar" role="tab" aria-controls="como-ajudar" aria-selected="true">Conteúdo da Página</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nova-aba-tab" data-bs-toggle="tab" href="#nova-aba" role="tab" aria-controls="nova-aba" aria-selected="false">Vagas Disponíveis</a>
                    </li>
                </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="como-ajudar" role="tabpanel" aria-labelledby="como-ajudar-tab">

                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="fas fa-plus"></i> Adicionar Novo Item
                </button>

                <!-- Modal para adicionar item -->
                <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addItemModalLabel">Adicionar Novo Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('como-ajudar.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Título</th>
                                <th class="text-center" style="max-width: 500px;">Descrição</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($content as $item)
                            <tr>
                                <td class="text-center">{{ $item->titulo }}</td>
                                <td class="text-center" style="max-width: 500px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $item->descricao }}
                                </td> 
                                <td class="text-center">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                        Editar
                                    </button>

                                    <form class="delete-form" action="{{ route('como-ajudar.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-btn">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal para edição -->
                            <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editItemModalLabel">Editar Item</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('como-ajudar.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="titulo" class="form-label">Título</label>
                                                    <input type="text" class="form-control" id="titulo" value="{{ $item->titulo }}" name="titulo" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descricao" class="form-label">Descrição</label>
                                                    <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ $item->descricao }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="tab-pane fade" id="nova-aba" role="tabpanel" aria-labelledby="nova-aba-tab">
                @include('como_ajudar.vagas')
            </div>
        </div>

        <script>
            function removeBanner(id, type) {
                showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
                    fetch(`{{ url('/imagens') }}/${id}/remover/como-ajudar`, {
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
                    .catch(error => console.error('Error:', error));
                });
            }

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
                        form.submit();
                    });
                });
            });
        </script>
    </div>
</x-app-layout>
