<x-app-layout>
    <div class="container my-5">

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-4">
                <h2 class="text-primary fw-bold text-center mb-4">Cadastrar Convênio ou Parceiro</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                <form action="{{ route('convenios.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required>
                                <label for="nome">Nome</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="tipo" id="tipo" class="form-select" required>
                                    <option value="Parceria">Parceria</option>
                                    <option value="Convenio">Convênio</option>
                                </select>
                                <label for="tipo">Tipo</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i> Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- LISTA DE CONVÊNIOS E PARCEIROS --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-dark fw-bold text-center mb-4">Lista de Convênios e Parcerias</h3>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($convenios as $convenio)
                                <tr>
                                    <td>{{ $convenio->nome }}</td>
                                    <td>{{ $convenio->tipo }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $convenio->id }}">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </button>
                                        <form id="delete-form-{{ $convenio->id }}" action="{{ route('convenios.destroy', $convenio->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $convenio->id }}')">
                                                <i class="bi bi-trash me-1"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <!-- Paginação -->
                    <div class="d-flex justify-content-center">
                        {{ $convenios->links() }}
                    </div>
                </div>

                {{-- Modais de edição fora da tabela --}}
                @foreach($convenios as $convenio)
                    <div class="modal fade" id="editModal{{ $convenio->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $convenio->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('convenios.update', $convenio->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content rounded">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Editar Convênio/Parceria</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nome" class="form-control" id="nome{{ $convenio->id }}" value="{{ $convenio->nome }}" required>
                                            <label for="nome{{ $convenio->id }}">Nome</label>
                                        </div>
                                        <div class="form-floating">
                                            <select name="tipo" id="tipo{{ $convenio->id }}" class="form-select" required>
                                                <option value="Parceria" {{ $convenio->tipo === 'Parceria' ? 'selected' : '' }}>Parceria</option>
                                                <option value="Convenio" {{ $convenio->tipo === 'Convenio' ? 'selected' : '' }}>Convênio</option>
                                            </select>
                                            <label for="tipo{{ $convenio->id }}">Tipo</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-1"></i> Salvar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>
