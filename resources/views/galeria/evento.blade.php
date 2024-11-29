<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Botão para adicionar novo evento -->
<button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addEventoModal">
    <i class="fas fa-plus"></i> Adicionar Novo Evento
</button>

<div class="modal fade" id="addEventoModal" tabindex="-1" aria-labelledby="addEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventoModalLabel">Adicionar Novo Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('eventos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control" id="data" name="data" required>
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
                <th class="text-center">Descrição</th>
                <th class="text-center">Data</th>
                <th class="text-center">Fotos</th>
                <th class="text-center">Videos</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($eventos) && $eventos->isNotEmpty())
                @foreach($eventos as $evento)
                <tr>
                    <td class="text-center">{{ $evento->titulo }}</td>
                    <td class="text-center" style="max-width: 500px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $evento->descricao }}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">
                        {{ $evento->fotos_count > 0 ? $evento->fotos_count : 'Sem fotos' }}
                    </td>
                    <td class="text-center">
                        {{ $evento->videos_count > 0 ? $evento->videos_count : 'Sem vídeos' }}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editEventoModal{{ $evento->id }}">
                            Editar
                        </button>
                        <form class="delete-form" action="{{ route('eventos.destroy', $evento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                <!-- Modal para editar evento -->
                <div class="modal fade" id="editEventoModal{{ $evento->id }}" tabindex="-1" aria-labelledby="editEventoModalLabel{{ $evento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEventoModalLabel">Editar Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título</label>
                                        <input type="text" class="form-control" id="titulo" value="{{ $evento->titulo }}" name="titulo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ $evento->descricao }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data" class="form-label">Data</label>
                                        <input type="date" class="form-control" id="data" value="{{ $evento->data }}" name="data" required>
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
            @else
                <tr>
                    <td colspan="6" class="text-center">Não existem eventos cadastrados.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const actionUrl = form.getAttribute('action');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você não poderá reverter isso!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar requisição para exclusão
                    fetch(actionUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Excluído!',
                                data.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Erro!',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao tentar excluir o evento.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script>


