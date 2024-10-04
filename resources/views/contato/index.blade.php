<x-app-layout>
    <div class="container-fluid mt-4 p-4">
    <h2>Contatos da Casa da Paz</h2>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addContatoModal">
    Adicionar Contato
</button>

<div class="row mt-3">
    @foreach($contatos as $contato)
        <div class="col-12 mb-3">
            <div class="card shadow-md rounded-lg p-4">
                <h5 class="font-semibold text-lg mb-2">{{ $contato->titulo }}</h5>
                <div class="d-flex justify-content-between">
                    <input type="text" class="form-control me-2" value="{{ $contato->contato }}" readonly>
                    <input type="text" class="form-control" value="{{ $contato->titulo }}" readonly>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="addContatoModal" tabindex="-1" role="dialog" aria-labelledby="addContatoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('contatos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addContatoModalLabel">Adicionar Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="contato">Contato</label>
                        <input type="text" class="form-control" name="contato" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</x-app-layout>
