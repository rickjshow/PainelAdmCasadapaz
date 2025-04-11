<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Pagina Bazar</h2>
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
                                <label for="imagem_bazar" class="form-label">Escolha as imagens</label>
                                <input type="file" name="imagem_bazar[]" class="form-control" accept="image/*" required multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form id="formExcluirSelecionados" action="{{ route('bazar.excluir-selecionados') }}" method="POST">
            @csrf
            @method('DELETE')

            <!-- Botão acima da galeria -->
            <div class="mt-4 mb-3">
                <button type="submit" class="btn btn-danger" onclick="return confirmarExclusaoSelecionados()">
                    <i class="fa fa-trash"></i> Excluir Selecionados
                </button>
            </div>

            <div class="row">
                @forelse($items as $id => $imagem)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow position-relative">

                            <!-- Checkbox -->
                            <div class="form-check position-absolute m-2">
                                <input type="checkbox" class="form-check-input imagem-checkbox" name="imagens[]" value="{{ $id }}">
                            </div>

                            <img src="{{ asset('storage/' . $imagem) }}" class="card-img-top" alt="Imagem do bazar">

                            <div class="card-body">
                                <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmDeleteBanner('{{ $id }}')">
                                    <i class="fa fa-trash"></i> Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-4">Nenhuma imagem encontrada.</p>
                @endforelse
            </div>
        </form>

        <script>
    function confirmDeleteBanner(id) {
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
                fetch(`{{ url('/bazar/destroy') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())  // Aguarde a resposta como JSON
                .then(data => {
                    if (data.message) {
                        Swal.fire(
                            'Excluído!',
                            data.message,  // Use a mensagem retornada pelo backend
                            'success'
                        ).then(() => location.reload());
                    } else {
                        Swal.fire(
                            'Erro!',
                            'Não foi possível excluir a imagem.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Erro!',
                        'Houve um problema ao excluir a imagem.',
                        'error'
                    );
                    console.error(error);  // Log de erro para facilitar depuração
                });

            }
        });
    }

    function confirmarExclusaoSelecionados() {
        const selecionadas = document.querySelectorAll('.imagem-checkbox:checked');

        if (selecionadas.length === 0) {
            Swal.fire('Nenhuma imagem selecionada', 'Por favor, selecione ao menos uma imagem.', 'warning');
            return false;
        }

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você deseja excluir as imagens selecionadas?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formExcluirSelecionados').submit();
            }
        });

        return false; // impede envio imediato
    }

</script>

    </div>
</x-app-layout>
