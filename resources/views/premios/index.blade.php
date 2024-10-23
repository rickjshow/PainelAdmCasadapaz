<x-app-layout>
    <div class="container mx-auto max-w-none mt-4">
        <h2 class="text-2xl font-bold mb-4">Pagina de Premios</h2>

        <form action="{{ route('banners-premios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-md rounded-lg p-4" style="height: 250px;">
                        <h5 class="font-semibold text-lg">Banner Desktop</h5>
                        <h4 class="mb-2 mt-2">Tamanho recomendado da imagem: 1920x170 </h4>
                        @if(isset($img) && $img->banner_principal)
                            <img src="{{ asset('storage/' . $img->banner_principal) }}" class="img-fluid mb-2" style="max-width: 400px;" />
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
                            <img src="{{ asset('storage/' . $img->banner_principal_mobile) }}" class="img-fluid mb-2" style="max-width: 100px;" />
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
                showConfirmAlert('Tem certeza?', 'Você não poderá reverter isso!', function() {
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
                            return showSuccessAlert('Excluído!', 'O banner foi excluído com sucesso.');
                        } else {
                            showErrorAlert('Erro!', 'Não foi possível excluir o banner.');
                            throw new Error('Erro na resposta');
                        }
                    })
                    .then(() => {
                        location.reload();
                    })
                    .catch(error => console.error('Erro:', error));
                });
            }
        </script>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Card 1 -->
            <div class="card bg-white shadow-md rounded-lg p-4">
                <h5 class="font-semibold text-lg">Card 1</h5>
                <p class="text-gray-700">Descrição do primeiro card. Informações importantes podem ser exibidas aqui.</p>
            </div>

            <!-- Card 2 -->
            <div class="card bg-white shadow-md rounded-lg p-4">
                <h5 class="font-semibold text-lg">Card 2</h5>
                <p class="text-gray-700">Descrição do segundo card. Mais detalhes ou informações relevantes podem ser colocadas aqui.</p>
            </div>

            <!-- Card 3 -->
            <div class="card bg-white shadow-md rounded-lg p-4">
                <h5 class="font-semibold text-lg">Card 3</h5>
                <p class="text-gray-700">Descrição do terceiro card. Use este espaço para destacar pontos-chave.</p>
            </div>
        </div>

        <h3 class="text-xl font-bold mb-4">Formulário de Contato</h3>
        <form action="#" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="nome" name="nome" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Digite seu nome">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Digite seu e-mail">
            </div>

            <div class="mb-4">
                <label for="mensagem" class="block text-sm font-medium text-gray-700">Mensagem</label>
                <textarea id="mensagem" name="mensagem" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Digite sua mensagem"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500">Enviar</button>
            </div>
        </form>
    </div>
</x-app-layout>
