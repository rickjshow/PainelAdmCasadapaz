<x-app-layout>
    <div class="container-fluid mt-4 p-4">
            <h2 class="text-2xl font-bold mb-4 text-center">Doações</h2>
                <form action="{{ route('banners-doacoes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-md rounded-lg p-4" style="height: 250px;">
                            <h5 class="font-semibold text-lg">Banner Desktop</h5>
                            <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 1920x170 </h4>
                            @if(isset($img) && $img->banner_principal)
                                <img src="{{ asset('storage/' . $img->banner_principal) }}" class="img-fluid mb-2" style="max-width: 400px; max-height: 50px;"/>
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
                        fetch(`{{ url('/imagens') }}/${id}/remover/doacoes`, {
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

            <form enctype="multipart/form-data">
                <div class="row mb-4 mt-4">
                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">Banco:</h5>
                            <input type="text" name="banco" class="form-control" value="{{ isset($content) ? $content->banco : '' }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">Agência:</h5>
                            <input type="text" name="agencia" class="form-control" value="{{ isset($content) ? $content->agencia : '' }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">Conta Corrente:</h5>
                            <input type="text" name="conta_corrente" class="form-control" value="{{ isset($content) ? $content->conta_corrente : '' }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">CNPJ:</h5>
                            <input type="text" id="cnpj" name="cnpj" class="form-control cnpj-mask" maxlength="18" value="{{ isset($content) ? preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $content->cnpj) : '' }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">Titular:</h5>
                            <input type="text" name="titular" class="form-control" value="{{ isset($content) ? $content->titular : '' }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">PIX:</h5>
                            <input type="text" name="pix" class="form-control" value="{{ isset($content) ? $content->pix : '' }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <script>
            $(document).ready(function() {

                $('.cnpj-mask').mask('00.000.000/0000-00');

                $('form').on('submit', function() {
                    var cnpj = $('#cnpj').val();
                    $('#cnpj').val(cnpj.replace(/\D/g, ''));
                });
            });
        </script>
</x-app-layout>
