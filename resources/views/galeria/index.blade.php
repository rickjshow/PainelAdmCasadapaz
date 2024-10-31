<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Página Galeria</h2>

        <form action="{{ route('banners-galeria.store') }}" method="POST" enctype="multipart/form-data">
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
            <button type="submit" class="btn btn-success mb-4 mt-2">Salvar</button>
        </form>

        <h2 class="text-2xl font-bold mt-4 mb-4 text-center">Imagens/Vídeos</h2>

        <ul class="nav nav-tabs mb-4 mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="galeria-tab" data-bs-toggle="tab" href="#galeria" role="tab" aria-controls="galeria" aria-selected="true">Conteúdo da Página</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="nova-aba-tab" data-bs-toggle="tab" href="#nova-aba" role="tab" aria-controls="nova-aba" aria-selected="false">Eventos</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="galeria" role="tabpanel" aria-labelledby="galeria-tab">
                <div class="d-flex justify-content-between mb-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArquivoModal">
                        Adicionar Arquivo
                    </button>

                    <form method="GET" action="{{ route('galeria.index') }}" class="d-flex align-items-center mb-4">
                        <select name="evento_id" class="form-control me-2">
                            <option value="">Selecione um Evento</option>
                            @foreach($eventos as $evento)
                                <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                            @endforeach
                        </select>
                        <select name="tipo" class="form-control me-2">
                            <option value="">Selecione o Tipo</option>
                            <option value="foto">Fotos</option>
                            <option value="video">Vídeos</option>
                        </select>
                        <input type="date" name="data_inicio" class="form-control me-2" placeholder="Data Início">
                        <input type="date" name="data_fim" class="form-control me-2" placeholder="Data Fim">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                </div>

                <div class="row">
                    @foreach($galeria as $item)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $item->arquivo) }}" class="card-img-top" alt="Imagem ou Vídeo">
                                <div class="card-body text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $item->id }}')">
                                        <i class="fa fa-trash"></i> Excluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="modal fade" id="addArquivoModal" tabindex="-1" aria-labelledby="addArquivoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addArquivoModalLabel">Adicionar Arquivo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="evento_id">Evento</label>
                                        <select name="evento_id" class="form-control" required>
                                            <option value="">Selecione um Evento</option>
                                            @foreach($eventos as $evento)
                                                <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo">Tipo</label>
                                        <select name="tipo" class="form-control" id="tipo" required>
                                            <option value="">Selecione um tipo de arquivo</option>
                                            <option value="foto">Foto</option>
                                            <option value="video">Vídeo</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="arquivo">Arquivo(s)</label>
                                        <input type="file" name="arquivo[]" class="form-control" accept="image/*,video/*" multiple required>
                                        <small>O tipo selecionado determina se apenas fotos ou vídeos serão enviados.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nova-aba" role="tabpanel" aria-labelledby="nova-aba-tab">
                @include('galeria.evento')
            </div>
        </div>

        <script>
            function removeBanner(id, type) {
                showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
                    fetch(`{{ url('/imagens') }}/${id}/remover/galeria`, {
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

            function confirmDelete(id) {
                if (confirm('Tem certeza de que deseja excluir este item?')) {
                    fetch(`{{ url('/galeria') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Erro ao excluir o item.');
                        }
                    });
                }
            }
        </script>
    </div>
</x-app-layout>
