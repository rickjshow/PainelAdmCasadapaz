<x-app-layout>
    <div class="container-fluid max-w-none mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Contatos</h2>

        {{--

        <form action="{{ route('banners-doacoes.store') }}" method="POST" enctype="multipart/form-data">
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
                        fetch(`{{ url('/imagens') }}/${id}/remover/contato`, {
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

        --}}

    <form action="{{ isset($content) ? route('contato.update', $content->id) : route('contato.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($content))
            @method('PATCH')
        @endif

        <div class="row mb-4 mt-4">
            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Telefone/WhatsApp:</h5>
                    <input type="text" name="whatsapp" class="form-control" value="{{ isset($content) ? $content->whatsapp : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Instagram Casa da Paz:</h5>
                    <input type="text" name="instagram" class="form-control" value="{{ isset($content) ? $content->instagram : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Fanpage:</h5>
                    <input type="text" name="fanpage" class="form-control" value="{{ isset($content) ? $content->fanpage : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">E-mail:</h5>
                    <input type="email" name="email" class="form-control" value="{{ isset($content) ? $content->email : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Endereço da Sede:</h5>
                    <input type="text" name="endereco_sede" class="form-control" value="{{ isset($content) ? $content->endereco_sede : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Endereço do Bazar e SEBO Literário:</h5>
                    <input type="text" name="endereco_bazar" class="form-control" value="{{ isset($content) ? $content->endereco_bazar : '' }}">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Instagram Bazar Beneficente:</h5>
                    <input type="text" name="instagram_bazar" class="form-control" value="{{ isset($content) ? $content->instagram_bazar : '' }}">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
    </div>
</x-app-layout>
