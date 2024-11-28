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
                            <button type="button" class="btn btn-danger btn-sm mt-3" onclick="confirmDeleteBanner('{{ $img->id }}', 'banner_principal')">
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
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteBanner('{{ $img->id }}', 'banner_principal_mobile')">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArquivoModal" style="height: 40px; margin-top: 30px;">
                        <i class="fas fa-plus"></i> Adicionar Arquivo
                    </button>

                    <form method="GET" action="{{ route('galeria.index') }}" class="d-flex align-items-center mb-4">
                        <div class="me-2">
                            <label for="evento_id" class="form-label">Evento</label>
                            <select id="evento_id" name="evento_id" class="form-control" style="width: 200px;">
                                <option value="">Selecione um Evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-2">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select id="tipo" name="tipo" class="form-control" style="width: 200px;">
                                <option value="">Selecione o Tipo</option>
                                <option value="foto">Fotos</option>
                                <option value="video">Vídeos</option>
                            </select>
                        </div>
                        <div class="me-2">
                            <label for="data_inicio" class="form-label">Data Início</label>
                            <input type="date" id="data_inicio" name="data_inicio" class="form-control" placeholder="Data Início">
                        </div>
                        <div class="me-2">
                            <label for="data_fim" class="form-label">Data Fim</label>
                            <input type="date" id="data_fim" name="data_fim" class="form-control" placeholder="Data Fim">
                        </div>
                        <button type="submit" class="btn btn-primary ml-4" style="height: 40px; margin-top: 30px;">Filtrar</button>
                    </form>
                </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="galeria" role="tabpanel" aria-labelledby="galeria-tab">
                    <div class="row">
                        @if(isset($galeria) && $galeria->isNotEmpty())
                            @foreach($galeria as $item)
                                <div class="col-md-3 mb-4 mt-4">
                                    <div class="card" style="border: none; height: 350px;">
                                        <div class="card-img-top" style="height: 100%; overflow: hidden; display: flex; align-items: center;">
                                            @if($item->tipo === 'foto')
                                                <!-- Exibir a imagem para fotos -->
                                                <img src="{{ asset('storage/' . $item->arquivo) }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                            @elseif($item->tipo === 'video')
                                                @php
                                                    $videoUrl = asset('videos_galeria/' . $item->arquivo);
                                                @endphp
                                                <video class="img-fluid w-100 h-100" style="object-fit: cover; cursor: pointer;"
                                                    onclick="openVideoModal('{{ $videoUrl }}')">
                                                    <source src="{{ $videoUrl }}" type="video/mp4">
                                                    Seu navegador não suporta a reprodução de vídeos.
                                                </video>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmDelete('{{ $item->id }}')">
                                            <i class="fa fa-trash"></i> Excluir
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center mt-4">Nenhuma foto ou vídeo encontrado</p>
                        @endif
                    </div>
                </div>


    <!-- Modal para reprodução do vídeo -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <video id="modalVideo" controls class="w-100">
                        <source id="modalVideoSource" src="" type="video/mp4">
                        Seu navegador não suporta a reprodução de vídeos.
                    </video>
>>>>>>> a6c0557ce095941aa226eafef905649432fe8304
                </div>
            </div>
        </div>
    </div>

    <script>
        function openVideoModal(videoUrl) {
            const modalVideoSource = document.getElementById('modalVideoSource');
            modalVideoSource.src = videoUrl;
            const modalVideo = document.getElementById('modalVideo');
            modalVideo.load(); // Carrega o novo vídeo
            modalVideo.play(); // Tenta reproduzir o vídeo
            new bootstrap.Modal(document.getElementById('videoModal')).show();
        }
    </script>


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
                                <select name="evento_id" class="form-control">
                                    <option value="">Selecione um Evento(Opcional)</option>
                                    @foreach($eventos as $evento)
                                        <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="arquivo">Arquivo(s)</label>
                                <input type="file" name="arquivo[]" class="form-control" accept="image/*,video/*" multiple required>
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
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você não poderá reverter isso!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/galeria/${id}/destroy`)
                    .then(response => {
                            Swal.fire(
                                'Excluído!',
                                'O item foi excluído com sucesso.',
                                'success'
                            ).then(() => {
                                window.location.href = response.data.redirect_url
                            });
                        })
                        .catch(error => {
                            Swal.fire(
                                'Erro!',
                                'Não foi possível excluir o item.',
                                'error'
                            );
                        });
                }
            });
        }

        function confirmDeleteBanner(id, type) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
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
                            Swal.fire(
                                'Excluído!',
                                'O banner foi excluído com sucesso.',
                                'success'
                            ).then(() => location.reload());
                        } else {
                            Swal.fire(
                                'Erro!',
                                'Não foi possível excluir o banner.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

</x-app-layout>
