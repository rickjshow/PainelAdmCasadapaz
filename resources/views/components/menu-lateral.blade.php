<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral com Ícones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/heroicons@1.0.6/dist/heroicons.min.css">
</head>
<body>
    <div class="flex">
        <!-- Menu Lateral -->
        <div class="w-60 bg-gray-800 text-white h-screen">
            <ul class="list-none p-0 m-0">
                <li class="border-b border-gray-700">
                    <a class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"></path></svg>
                        Banners
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12"></path></svg>
                        Galeria
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.5-4.5m0 0L19 7m0-2l-4.5 4.5M9 15L4.5 19m0 0L5 16m-1 1L9 15m-4-3h12"></path></svg>
                        Textos
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6m-9 4H4a2 2 0 00-2 2v4a2 2 0 002 2h1m4 0h6v-6H9v6z"></path></svg>
                        Bazar
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 6h16M4 14h16m-8 4h8M4 18h8m-4-8v4"></path></svg>
                        Vagas
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a id="toggleOutros" class="block p-4 hover:bg-gray-700 cursor-pointer flex items-center">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        Outros
                    </a>
                    <ul id="subMenuOutros" class="list-none pl-4 hidden">
                        <li><a class="block p-4 hover:bg-gray-600">Subitem 1</a></li>
                        <li><a class="block p-4 hover:bg-gray-600">Subitem 2</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Conteúdo Principal -->
        <div class="flex-1 p-4">
            <!-- Conteúdo vai aqui -->
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById('toggleOutros').addEventListener('click', function() {
            const subMenu = document.getElementById('subMenuOutros');
            subMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
