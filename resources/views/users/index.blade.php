<x-app-layout>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold text-center mb-4">Lista de Usuários</h2>

        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Criar Usuário
        </button>

        <table class="table table-bordered table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($users))
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ ucfirst($user->type) }}</td>
                            <td class="text-center">
                                @if($user->is_active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-danger">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <!-- Alterar tipo -->
                                <form action="{{ route('users.toggle-type', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Alterar Tipo</button>
                                </form>

                                <form action="{{ route('users.toggle-situation', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">
                                        {{ $user->is_active ? 'Desativar' : 'Ativar' }}
                                    </button>
                                </form>

                                <button type="button" class="btn btn-primary open-modal-btn btn-sm" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">Editar</button>

                                <!-- Excluir usuário -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">Excluir</button>
                                </form>

                                <!-- Resetar senha (somente admin) -->
                                @if(auth()->user()->type == 'admin')
                                    <form action="{{ route('users.reset-password', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm">Resetar Senha</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">Nenhum usuário encontrado.</p>
                </div>
            @endif
            </tbody>
        </table>
    </div>

    <!-- Modal de Criação de Usuário -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Cabeçalho do Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Criar Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Corpo do Modal -->
                <div class="modal-body">
                    <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipo</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="admin">Administrador</option>
                                <option value="user">Usuário</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Criar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($user))
        <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel{{ $user->id }}">Editar Usuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Nome -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <!-- E-mail -->
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <!-- Tipo -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo</label>
                                <select name="type" id="type" class="form-select" disabled>
                                    <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>Usuário</option>
                                </select>
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
    @endif

    <!-- Script SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Tem certeza?',
                        text: 'Você não poderá reverter essa ação!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>


</x-app-layout>
