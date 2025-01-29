<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Pagina Bazar</h2>

        <form action="{{ route('banners-bazar.store') }}" method="POST" enctype="multipart/form-data">
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

        <script>
            function removeBanner(id, type) {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Você não poderá reverter isso!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ url('/imagens') }}/${id}/remover/bazar`, {
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
                        })
                        .catch(error => console.error('Erro:', error));
                    }
                });
            }

        </script>

        <h2 class="text-2xl font-bold mt-4 mb-4 text-center">Imagens</h2>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArquivoModal">
            <i class="fas fa-plus"></i> Adicionar Imagem
        </button>

        <div class="modal fade" id="addArquivoModal" tabindex="-1" aria-labelledby="addArquivoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('bazar.addImg') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Imagem</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="imagem_bazar" class="form-label">Escolha uma imagem</label>
                                <input type="file" name="imagem_bazar" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @forelse($items as $item)
                <div class="col-md-3 mb-4">
                    <div class="card shadow">
                        <img src="{{ asset('storage/' . $item->arquivo) }}" class="card-img-top" alt="Imagem do bazar">
                        <div class="card-body">
                            <form action="{{ route('bazar.destroyImg', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta imagem?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fa fa-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center mt-4">Nenhuma imagem encontrada.</p>
            @endforelse
        </div>

    <script>
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

    </div>
</x-app-layout>
