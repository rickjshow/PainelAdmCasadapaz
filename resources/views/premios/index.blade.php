<x-app-layout>
    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-bold mb-4">Pagina de Premios</h2>

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
