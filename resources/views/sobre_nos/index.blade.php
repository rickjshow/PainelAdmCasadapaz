<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Sobre Nós</h2>

        <!-- Cards para Imagens -->
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Banner Desktop</h5>
                    <input type="file" accept="image/*" name="banner_desktop" class="form-control mb-2" />
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Banner Mobile</h5>
                    <input type="file" accept="image/*" name="banner_mobile" class="form-control mb-2" />
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>

        <!-- Campo para Imagem da Missão -->
        <div class="card shadow-md rounded-lg p-4 mb-4">
            <h5 class="font-semibold text-lg mb-2">Imagem da Missão</h5>
            <input type="file" accept="image/*" name="imagem_missao" class="form-control mb-2" />
            <button class="btn btn-primary">Enviar</button>
        </div>

        <!-- Campos de Texto -->
        <div class="row mb-4">
            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Sobre a Casa da Paz</h5>
                    <textarea name="sobre_casa" class="form-control" rows="3"></textarea>
                    <button class="btn btn-success mt-2">Salvar</button>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">No que acreditamos?</h5>
                    <textarea name="no_que_acreditamos" class="form-control" rows="3"></textarea>
                    <button class="btn btn-success mt-2">Salvar</button>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Onde e como as atividades acontecem?</h5>
                    <textarea name="onde_atividades" class="form-control" rows="3"></textarea>
                    <button class="btn btn-success mt-2">Salvar</button>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">De onde vêm os recursos?</h5>
                    <textarea name="de_onde_recursos" class="form-control" rows="3"></textarea>
                    <button class="btn btn-success mt-2">Salvar</button>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow-md rounded-lg p-4">
                    <h5 class="font-semibold text-lg mb-2">Sede própria!</h5>
                    <textarea name="sede_propria" class="form-control" rows="3"></textarea>
                    <button class="btn btn-success mt-2">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-center">Equipe</h2>

    <button type="button" class="btn btn-primary mb-4" id="openModalCreate">
        Adicionar Membro
    </button>


    <div class="row">
        @if(isset($equipes) && $equipes->isNotEmpty())
            @foreach ($equipes as $equipe)
                <div class="col-md-3 text-center mb-4">
                    <div class="card mb-4 shadow-sm border-light">
                        <div style="height: 350px; overflow: hidden;">
                        <img src="{{ url('/imagem/' . $equipe->foto) }}" alt="Foto da equipe">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $equipe->nome }}</h5>
                            <p class="card-text">{{ $equipe->cargo }}</p>
                            <p class="card-text text-muted">{{ $equipe->profissao }}</p>
                            <button class="btn btn-warning open-modal-btn" data-id="{{ $equipe->id }}">
                                Editar
                            </button>
                            <form action="{{ route('equipes.destroy', $equipe->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-btn">Excluir</button>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var deleteButtons = document.querySelectorAll('.delete-btn');

                                    deleteButtons.forEach(function (button) {
                                        button.addEventListener('click', function (event) {
                                            event.preventDefault();
                                            var form = this.closest('form');

                                            Swal.fire({
                                                title: 'Tem certeza?',
                                                text: "Você não poderá reverter isso!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Sim, excluir!',
                                                cancelButtonText: 'Cancelar'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    form.submit();
                                                }
                                            });
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEdit{{ $equipe->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $equipe->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('equipes.update', $equipe->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel{{ $equipe->id }}">Editar Membro</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome" value="{{ $equipe->nome }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cargo" class="form-label">Cargo</label>
                                        <input type="text" class="form-control" name="cargo" value="{{ $equipe->cargo }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Profissão</label>
                                        <textarea class="form-control" name="profissao" required>{{ $equipe->profissao }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" name="foto" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var openModalBtns = document.querySelectorAll('.open-modal-btn');
                        openModalBtns.forEach(function (btn) {
                            btn.addEventListener('click', function () {
                                var equipeId = btn.getAttribute('data-id');
                                var modal = new bootstrap.Modal(document.getElementById('modalEdit' + equipeId));
                                modal.show();
                            });
                        });

                        document.getElementById('openModalCreate').onclick = function () {
                            var modal = new bootstrap.Modal(document.getElementById('modalCreate'));
                            modal.show();
                        };
                    });
                </script>

                @endforeach
            @else
                <p class="text-center">Nenhum membro da equipe cadastrado no momento.</p>
            @endif
        </div>

        <!-- Modal de Criação -->
        <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('equipes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCreateLabel">Adicionar Membro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" name="cargo" required>
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Profissão</label>
                                <textarea class="form-control" name="profissao" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('openModalCreate').onclick = function () {
                    var modal = new bootstrap.Modal(document.getElementById('modalCreate'));
                    modal.show();
                };
            });
        </script>
    </div>
</x-app-layout>
