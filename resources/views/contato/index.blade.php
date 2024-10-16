<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Contatos</h2>
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
