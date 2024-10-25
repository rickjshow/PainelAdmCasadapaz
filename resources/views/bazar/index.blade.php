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
                showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
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

    </div>
</x-app-layout>
