<x-app-layout>
    <div class="container-fluid mt-4 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Doações</h2>
        <form action="{{ isset($content) ? route('doacao.update', $content->id) : route('doacao.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($content))
                @method('PATCH')
            @endif

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
                        <input type="text" name="cnpj" class="form-control" maxlength="14" value="{{ isset($content) ? $content->cnpj : '' }}">
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

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</x-app-layout>
