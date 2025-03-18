<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Pagina de Premios</h2>

        {{--

        <form action="{{ route('banners-premios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
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

            <button type="submit" class="btn btn-success mt-2 mb-5">Salvar</button>
        </form>

        --}}

        <form action="{{ isset($texto) ? route('texto.update', $texto->id) : route('texto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($texto))
                    @method('PATCH')
                @endif

                <div class="row mb-4 mt-4">
                    <div class="col-12 mb-3">
                        <div class="card shadow-md rounded-lg p-4">
                            <h5 class="font-semibold text-lg mb-2">Texto Príncipal</h5>
                            <input type="text" name="texto_principal" class="form-control" value="{{ isset($texto) ? $texto->texto_principal : '' }}">
                        </div>
                    </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-success mt-2">Salvar</button>
                </div>
        </form>

        <div class="row mt-5">
            <h3 class="text-2xl font-bold mb-4 text-center">Prêmios da Casa da Paz</h3>
            <div class="d-flex mb-4">
                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addPremioModal">
                    Adicionar Novo Prêmio
                </button>
            </div>
            @if(isset($premios) && $premios->isNotEmpty())
                @foreach ($premios as $premio)
                    <div class="col-md-3 mb-4 mt-4">
                        <div class="card shadow-md rounded-lg p-3 text-center">
                            <img src="{{ asset('storage/' . $premio->imagem) }}" class="img-fluid mb-2" style="width: 100%; height: 100%; object-fit: cover;" alt="Imagem do Prêmio">
                            <h5 class="font-semibold">{{ $premio->nome }}</h5>
                            <div class="d-flex justify-content-center mt-2">
                            <button type="button" class="btn btn-warning open-modal-btn mr-2" data-id="{{ $premio->id }}">
                                Editar
                            </button>
                            <form action="{{ route('premios.destroy', $premio->id) }}" method="POST" class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-btn">Excluir</button>
                            </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalEdit{{ $premio->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $premio->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('premios.update', $premio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel{{ $premio->id }}">Editar Premios</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome" value="{{ $premio->nome }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descricao</label>
                                        <textarea class="form-control" name="descricao" required>{{ $premio->descricao }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="imagem" class="form-label">Imagem</label>
                                        <h5 class="mb-2 mt-2">Tamanho recomendado da imagem: 325x272</h5>
                                        <input type="file" class="form-control" name="imagem" accept="image/*">
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
                <p class="text-center">Nenhum prêmio encontrado</p>
            @endif
        </div>

        <div class="modal fade" id="addPremioModal" tabindex="-1" aria-labelledby="addPremioModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPremioModalLabel">Adicionar Novo Prêmio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('premios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Prêmio</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imagem" class="form-label">Imagem do Prêmio</label>
                                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    fetch(`{{ url('/imagens') }}/${id}/remover/premios`, {
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


        document.addEventListener('DOMContentLoaded', () => {
        // Abre o modal de criação
        document.getElementById('openModalCreate').addEventListener('click', function () {
            const modalCreate = new bootstrap.Modal(document.getElementById('modalCreate'));
            modalCreate.show();
        });

    });

    </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');

                // Exibe o alerta de confirmação
                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Você não poderá reverter isso!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        // Envia a requisição DELETE usando fetch
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                _method: 'DELETE',
                            }),
                        })
                        .then(response => {
                            if (response.ok) {
                                // Alerta de sucesso e recarrega a página
                                Swal.fire({
                                    title: 'Excluído!',
                                    text: 'O prêmio foi excluído com sucesso.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                // Alerta de erro
                                Swal.fire({
                                    title: 'Erro!',
                                    text: 'Não foi possível excluir o prêmio.',
                                    icon: 'error',
                                    confirmButtonColor: '#d33',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            // Alerta no caso de falha inesperada
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Ocorreu um erro ao excluir o prêmio.',
                                icon: 'error',
                                confirmButtonColor: '#d33',
                            });
                        });
                    }
                });
            });
        });
    });
</script>


</x-app-layout>
